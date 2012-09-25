<?php
require_once 'bank/Data/SEPAPaymentDataMapper.php';
/**
 *  SEPAPayments.php
 *
 *  Copyright information
 *
 *      Copyright (C) 2012 Jarmo Kortetjärvi <jarmo.kortetjarvi@futurable.fi>
 *
 *
 *  License
 *
 *      This file is part of project Futural/bank.
 *
 *		This program is free software: you can redistribute it and/or modify
 *		it under the terms of the GNU General Public License as published by
 * 		the Free Software Foundation, either version 3 of the License, or
 *		(at your option) any later version.
 *
 *		This program is distributed in the hope that it will be useful,
 *		but WITHOUT ANY WARRANTY; without even the implied warranty of
 *		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *		GNU General Public License for more details.
 *
 *		You should have received a copy of the GNU General Public License
 *		along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * SEPAPayments.php
 * Class for creating SEPA formatted payment data
 * 
 * @package   UI
 * @author    Jarmo Kortetjärvi
 * @copyright 2012 <jarmo.kortetjarvi@futurable.fi>
 * @license   GPLv3 or any later version
 * @version   2012-05-22
 */

class SepaPayment {
	
	private $camtType;
	private $statementType;
	private $metaData;
	private $XML;
	private $user;
	private $bankAccount;
	private $fileName;
	private $MsgId;
	public  $dataMapper;
	
	// XML data variables
	private $FrDtTm;				// From datetime
	private $ToDtTm;				// To datetime
	private $CreDtTm;				// Create datetime
	private $NtryRef;				// Entry reference number
	private $TtlCdtNtriesNb;		// Total credit entries
	private $TtlDbtNtriesNb;		// Total debit entries
	private $TtlCdtNtriesSum;		// Total credit entries sum
	private $TtlDbtNtriesSum;		// Total debit entries sum
	private $ElctrncSeqNb;			// Electronic sequence number
	private $LglSeqNb;				// Legal sequence number
	
	public function __construct( User $user, BankAccount $bankAccount, $camtType ){
		$this->setCamtType($camtType);
		$this->setStatementType();
		$this->setUser($user);
		$this->createSequenceNumbers();
		$this->setBankAccount($bankAccount);
		$bankAccount->getUncollectedTransactions($this->getStatementType());
		$this->startDocument();
		$this->createGrpHdr();
		$this->createStmt();
		
		$this->dataMapper = new SEPAPaymentDataMapper();
	}
	
	/**
	 * Start XML document and set metadata
	 */
	private function startDocument(){
		$metaData = $this->getMetaData();
		
		$meta  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$meta .= "<Document ";
		$meta .= "xmlns=\"{$metaData['schema']}\" ";
		$meta .= "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ";
		$meta .= "xsi:schemaLocation=\"{$metaData['schema']} {$metaData['location']}\">";
		$meta .= "</Document>";

		$xml = new SimpleXMLElement($meta);
		$xml->addChild('BkToCstmrStmt');
		
		$this->setXML($xml);
	}
	
	/**
	 * Get XML document as .xml file
	 */
	public function getDocumentAsXML(){
		$companyName = $this->getUser()->getCompany();
		$camtType = $this->getCamtType();
		
		$fileName = "XMLStatement-".$companyName.date('-Y.m.d.h.i.s-').$camtType.".xml";
		$this->setFileName($fileName);
		$filePath = "SEPAFiles/";
		$fileHandle = fopen($filePath.$fileName, "w+");
		if (!$fileHandle) {
			$message = "<p class='incorrect'>".gettext('Error while opening file. Please contact administration').".</p>";
			exit;
		}
		else{
			$xml = $this->getXML();
			// Convert to utf-8 before writing
			$writtenBytes = fwrite( $fileHandle, mb_convert_encoding($xml->asXML(), 'UTF-8', 'auto') );
			fclose( $fileHandle );
			
			if($writtenBytes != 0) $message = "<p class='correct'>".gettext('File successfully saved').".</p>";
		}
		
		echo $message;
	}
	
	private function createSequenceNumbers(){
		$query = "	SELECT 	MAX(ElctrncSeqNb)+1 AS ElctrncSeqNb
							, COUNT( IF( YEAR(CreateDate) = YEAR(NOW()) , ElctrncSeqNb, NULL) ) AS LglSeqNb
					FROM BankSEPAFiles";
		$result = @mysql_query($query);
		
		if($result){
			$row = @mysql_fetch_assoc($result);
			
			$this->setElctrncSeqNb($row['ElctrncSeqNb']);
			$this->setLglSeqNb($row['LglSeqNb']);
			
			$success = true;
		}
		else $success = false;
		
		return $success;
	}
	
	/**
	 * Create group header for the statement
	 */
	private function createGrpHdr(){
		$xml = $this->getXML();
		
		// Create group header parent
		$GrpHdr = $xml->BkToCstmrStmt->addChild('GrpHdr');
		
		// Create children
		$TmpId = 'OIVAFILE'.substr(uniqid(), -8);
		$this->setMsgId($TmpId);
		$MsgId = $GrpHdr->addChild('MsgId', $TmpId);
		$CreDtTm = $GrpHdr->addChild('CreDtTm', CommonFunctions::getUTCFormattedDate() );
		
		$this->setXML($xml);
	}
	
	/**
	 * Create statement section for the statement
	 */
	private function createStmt(){
		$xml = $this->getXML();
		$CreDtTm = date('Y-m-d H:i:s');
		$this->setCreDtTm($CreDtTm);
		
		// Create statement parent
		$Stmt = $xml->BkToCstmrStmt->addChild('Stmt');
		
		// Create Childen		
		$Stmt->addChild('Id', 'OIVASTMT'.substr(uniqid(), -8));						// Identification
		$Stmt->addChild('ElctrncSeqNb', $this->getElctrncSeqNb());					// Electronic Sequence number
		$Stmt->addChild('LglSeqNb', $this->getLglSeqNb());							// Legal Sequence number
		$Stmt->addChild('CreDtTm', CommonFunctions::getUTCFormattedDate($CreDtTm));	// Creation DateTime, UTC-fomatted (Y-m-d\Th:m:iO)
		$Stmt->addChild('FrToDt', "");												// FromToDate
			$this->createFrToDt();
		$Stmt->addChild('CpyDplctInd', "");											// Copy Duplicate Indicator ('', 'COPY', 'DUPL')
		$Stmt->addChild('RptgSrc', "");												// Reporting source
		$Stmt->addChild('Acct', "");												// Account
			$this->createAcct();
		$Stmt->addChild('RltdAcct', "");											// Related account (upper level account)
			$this->createRltdAcct();
		$Stmt->addChild('Intrst', "");												// Interest
		$this->createBal();															// Balance info
		$Stmt->addChild('TxsSummry', "");											// Transactions summary
		$this->createEntries();														// Entries
		$this->createTxsSummry();													// Transactions summary, has to be filled after 'createEntries' function
		$Stmt->addChild('AddtlStmtInf', "");										// Additional statement information
		
		$this->setXML($xml);
	}
	
	/**
	 * Create from to date (FrToDt) section for statement
	 */
	private function createFrToDt(){
		$xml = $this->getXML();
		$transactions = $this->getBankAccount()->getTransactions();
		$lastKey = count($transactions) - 1;

		if(!empty($transactions)){
			$firstDate =  $transactions[0]->getEventDate().date(' 02:00:00');
			$lastDate  = $transactions[$lastKey]->getEventDate().date(' 21:00:00');
		}
		else{
			$firstDate = date('Y-m-d 02:00:00');
			$lastDate = date('Y-m-d 21:00:00');
		}
		
		
		$this->setFrDtTm($firstDate);
		$this->setToDtTm($lastDate);
		
		$FrToDt = $xml->BkToCstmrStmt->Stmt->FrToDt;
		$FrToDt->addChild( 'FrDtTm', CommonFunctions::getUTCFormattedDate( $firstDate) );
		$FrToDt->addChild( 'ToDtTm', CommonFunctions::getUTCFormattedDate( $lastDate) );
	}
	
	/**
	 * Create account (Acct) section for statement
	 */
	private function createAcct(){
		$xml = $this->getXML();
		$bankAccount = $this->getBankAccount();
		
		$IBAN = $bankAccount->getIBAN();
		$Ccy = $bankAccount->getCurrency();
		$Nm = $bankAccount->getAccountOwnerName();
		
		$Acct = $xml->BkToCstmrStmt->Stmt->Acct;
		
		$Id = $Acct->addChild('Id', '');											// Identification, Account Id
			$Id->addChild('IBAN', $IBAN);											// Account IBAN
		$Tp = $Acct->addChild('Tp');
			$Tp->addChild('Cd', 'CACC');											// Type (CACC = Current account)
		$Acct->addChild('Ccy', $Ccy);												// Main currency of the account
		$Acct->addChild('Nm', $Nm);													// Name of the account
		$this->createOwnr();														// Owner of the account
		$this->createSvcr();														// Servicer (the bank BIC code)
	
		$this->setXML($xml);
	}
	
	/**
	 * Create parent account (RltdAcct)
	 */
	private function createRltdAcct(){
		$xml = $this->getXML();
		$bankAccount = $this->getBankAccount();
		
		$IBAN = $bankAccount->getIBAN();
		$Ccy = $bankAccount->getCurrency();
		
		$RltdAcct = $xml->BkToCstmrStmt->Stmt->RltdAcct;
		
		$Id = $RltdAcct->addChild('Id');
			$Id->addChild('IBAN', $IBAN);
		$RltdAcct->addChild('Ccy', $Ccy);
	}
	
	/**
	 * Create Transactions summary (TxsSummry) for statement
	 */
	private function createTxsSummry(){
		$xml = $this->getXML();
		$TxsSummry = $xml->BkToCstmrStmt->Stmt->TxsSummry;
		$TtlCdtNtriesNb = $this->getTtlCdtNtriesNb();
		$TtlDbtNtriesNb = $this->getTtlDbtNtriesNb();
		$TtlCdtNtriesSum = $this->getTtlCdtNtriesSum();
		$TtlDbtNtriesSum = $this->getTtlDbtNtriesSum();
		
		// Total transactions
		$TxsSummryTtlNtries = $TxsSummry->addChild('TtlNtries');
			$TxsSummryTtlNtries->addChild('NbOfNtries', ($TtlCdtNtriesNb+$TtlDbtNtriesNb));
			$TxsSummryTtlNtries->addChild('Sum', ($TtlCdtNtriesSum+$TtlDbtNtriesSum));
		
		// Deposits
		$TxsSummryTtlCdtNtries = $TxsSummry->addChild('TtlCdtNtries');
			$TxsSummryTtlCdtNtries->addChild('NbOfNtries', $TtlCdtNtriesNb);
			$TxsSummryTtlCdtNtries->addChild('Sum', $TtlCdtNtriesSum);
		
		// Withdrawls
		$TxsSummryTtlDbtNtries = $TxsSummry->addChild('TtlDbtNtries');
			$TxsSummryTtlDbtNtries->addChild('NbOfNtries', $TtlDbtNtriesNb);
			$TxsSummryTtlDbtNtries->addChild('Sum', $TtlDbtNtriesSum);
		
		$this->setXML($xml);
	}
	
	/**
	 * Create balance (Bal) sections for statement
	 */
	private function createBal(){
		$xml = $this->getXML();
		
		// OPBD Bal child (Book balance of the account at the beginning of the account reporting period)
		$BalOPBD = $xml->BkToCstmrStmt->Stmt->addChild('Bal');
			$BalOPBDTp = $BalOPBD->addChild('Tp', "");
				$BalOPBDTpCdOrPrtry = $BalOPBDTp->addChild('CdOrPrtry', "");
					$BalOPBDTpCdOrPrtry->addChild('Cd', "OPBD");
		
		// CLBD Bal child (Closing book balance of the account at the end of the account reporting period)
		$BalCLBD = $xml->BkToCstmrStmt->Stmt->addChild('Bal');
			$BalCLBDTp = $BalCLBD->addChild('Tp', "");
				$BalCLBDTpCdOrPrtry = $BalCLBDTp->addChild('CdOrPrtry', "");
					$BalCLBDTpCdOrPrtry->addChild('Cd', "CLBD");
	}
	
	/**
	 * Create owner info (Ownr)
	 */
	private function createOwnr(){
		$xml = $this->getXML();
		$bankAccount = $this->getBankAccount();
		$user = $this->getUser();
		$businessID = $user->getCompanyBusinessID();
		
		$Nm = $bankAccount->getAccountOwnerName();
		$BusinessId = $businessID; // TODO: get Business ID (y-tunnus)
		
		$Ownr = $xml->BkToCstmrStmt->Stmt->Acct->addChild('Ownr');
		$Ownr->addChild('Nm', $Nm);
		
		// Postal address information
		$PstlAdr = $Ownr->addchild('PstlAdr');
			// TODO: account owner info
			$PstlAdr->addChild('StrtNm', '');						// Street name
			$PstlAdr->addChild('BldgNb', '');						// Building number
			$PstlAdr->addChild('PstCd', '');						// Postal code
			$PstlAdr->addChild('TwnNm', '');						// Town name
			$PstlAdr->addChild('Ctry', '');							// County abbreviation (ie. 'FI')
			
		// Id information (organisation information)
		$Id = $Ownr->addChild('Id');
			$OrgId = $Id->addChild('OrgId');
				$Othr = $OrgId->addChild('Othr');
					$Othr->addChild('Id', $BusinessId );			// Finnish Organisation Id (y-tunnus)
					$SchemeNm = $Othr->addChild('SchmeNm');
						$SchemeNm->addChild('Cd', '');				// TODO: Recipient's bank Id.  In case of Finnish Y-tunnus use "CUST"
	}
	
	/**
	 * Create servicer info (Svcr)
	 */
	private function createSvcr(){
		$xml = $this->getXML();
		$bankAccount = $this->getBankAccount();
		$BIC = $bankAccount->getBIC(); 
		
		$Svcr = $Ownr = $xml->BkToCstmrStmt->Stmt->Acct->addChild('Svcr');
			$FinInstnId = $Svcr->addChild('FinInstnId');
				$FinInstnId->addChild('BIC', $BIC);
	}
	
	/**
	 * Create entries
	 */
	private function createEntries(){
		$transactions = $this->getBankAccount()->getTransactions();
		$i = 0;
		if(!empty($transactions)){
			foreach($transactions as $transaction){
				$i++;
				$this->setNtryRef($i);
				$this->createNtry($transaction);
			}
		}
	}
	
	/**
	 * Create a single entry
	 */
	private function createNtry($transaction){
		$xml = $this->getXML();
		$Ntry = $xml->BkToCstmrStmt->Stmt->addChild('Ntry');

		// Format amount
		if( $transaction->getSum() < 0 ){
			$Amt = number_format( $transaction->getSum()*-1, 2 );
			$CdtDbtInd = "DBIT";
			
			// Fill variables for transactions summary
			$this->addDbtNtryNb();
			$this->addDbtNtrySum($Amt);
		} else {
			$Amt = number_format( $transaction->getSum() );
			$CdtDbtInd = "CRDT";
			
			// Fill variables for transactions summary
			$this->addCdtNtryNb();
			$this->addCdtNtrySum($Amt);
		}
		
		$Ntry->addChild('NtryRef', $this->getNtryRef()); // Reference number
			$Amt = $Ntry->addChild('Amt', $Amt);
				$Amt->addAttribute('Ccy', $transaction->getCurrency() ); // Currency
			$Ntry->addChild('CdtDbtInd', $CdtDbtInd);
			$Ntry->addChild('Sts', '');
			$BookgDt= $Ntry->addChild('BookgDt');
				$BookgDt->addChild('Dt', $transaction->getCreateDate());
			$ValDt= $Ntry->addChild('ValDt');
				$ValDt->addChild('Dt', $transaction->getEventDate());
			$Ntry->addChild('AcctSvcrRef', '');
			$BkTxCd = $Ntry->addChild('BkTxCd');
				$Domn = $BkTxCd->addChild('Domn');
					$Domn->addChild('Cd', '');
					$Fmly = $Domn->addChild('Fmly');
						$Fmly->addChild('Cd','');
						$Fmly->addChild('SubFmlyCd','');
				$Prtry = $BkTxCd->addChild('Prtry');
					$Prtry->addChild('Cd');
					$Prtry->addChild('Issr');
			$NtryDtls = $Ntry->addchild('NtryDtls');
				$Btch = $NtryDtls->addChild('Btch');
					$Btch->addChild('MsgId', '');
					$Btch->addChild('PmtInfId', '');
					$Btch->addChild('NbOfTxs', '');
				$TxDtls = $NtryDtls->addChild('TxDtls');
					$AmtDtls = $TxDtls->addChild('AmtDtls');
						$TxAmt = $AmtDtls->addChild('TxAmt');
							$Amt = $TxAmt->addChild('Amt', $Amt);
								$Amt->addAttribute('Ccy', $transaction->getCurrency());
					$RltdDts = $TxDtls->addChild('RltdDts');
						$RltdDts->addChild('AccptncDtTm', $transaction->getEventDate());
					$Purp = $TxDtls->addChild('Purp');
						$Purp->addChild('Cd', '');
		
		$this->setXML($xml);
	}
	
	/**
	 *  Setters and getters
	 */
	
	// XML file contents
	public function setXML($xml){
		// TODO: check if XML
		$this->XML = $xml;
	}
	public function getXML(){
		if(isset($this->XML)){
			return $this->XML;
		}
	}
	
	/**
	 * Statement type setter.
	 * Valid statement types:
	 * 		camt052
	 * 		camt053
	 * 		camt054
	 * 
	 * @param string	$camtType
	 * @return boolean	$success
	 */
	public function setCamtType($camtType){
		$success = false;
		
		// Valid statement types
		$camtTypes = array(
			'camt052'	=> 	array("schema" => "urn:iso:std:iso:20022:tech:xsd:camt.052.001.02", "location" => "camt.052.001.02.xsd")
			, 'camt053'	=>	array("schema" => "urn:iso:std:iso:20022:tech:xsd:camt.053.001.01", "location" => "camt.053.001.02.xsd")
			, 'camt054'	=>	array("schema" => "urn:iso:std:iso:20022:tech:xsd:camt.054.001.02", "location" => "camt.054.001.02.xsd")
		);
		
		if( array_key_exists($camtType, $camtTypes) ){
			$this->camtType = $camtType;
			$this->setMetadata($camtTypes[$camtType]);
			$success = true;
		}
		else $success = false;
		
		return $success;
	}
	public function getCamtType(){
		if(isset($this->camtType)) return $this->camtType;
	}
	
	/**
	 * Set statement type via camt type
	 */
	public function setStatementType(){
		$statementType = null;
		if(isset($this->camtType)){
			$camtType = $this->getCamtType();
			switch ($camtType){
				case "camt052":
					$statementType = null;
					break;
				case "camt053":
					$statementType = 'AccountStatement';
					break;
				case "camt054":
					$statementType = 'ReferenceMaterial';
					break;
				default:
					$statementType = null;
			}
		}
		
		$this->statementType = $statementType;
	}
	public function getStatementType(){
		if(isset($this->statementType)){
			return $this->statementType;
		}
	}
	
	// Bankaccount
	public function setBankAccount($bankAccount){
		if(is_object($bankAccount)){
			$this->bankAccount = $bankAccount;
		}
	}
	public function getBankAccount(){
		return $this->bankAccount;
	}
	
	// Metadata
	public function setMetadata($metaData){
		if(is_array($metaData)){
			$this->metaData = $metaData;
		}
	}
	public function getMetaData(){
		if(isset($this->metaData)) return $this->metaData;
	}
	
	// User
	public function setUser(User $user){
		if(is_object($user)){
			$this->user = $user;
		}
	}
	public function getUser(){
		if(isset($this->user)) return $this->user;
	}
	
	// Message ID (MsgId)
	public function setMsgId($MsgId){
		if(is_string($MsgId)){
			$this->MsgId = $MsgId;
		}
	}
	public function getMsgId(){
		if(isset($this->MsgId)){
			return $this->MsgId;
		}
	}
	
	// From datetime (FrDtTm)
	public function setFrDtTm($FrDtTm){
		if(DataValidator::isDateTimeISOSyntaxValid($FrDtTm)){
			$this->FrDtTm = $FrDtTm;
		}
	}
	public function getFrDtTm(){
		if(isset($this->FrDtTm)){
			return $this->FrDtTm;
		}
	}
	
	// To datetime (ToDtTm)
	public function setToDtTm($ToDtTm){
		if(DataValidator::isDateTimeISOSyntaxValid($ToDtTm)){
			$this->ToDtTm = $ToDtTm;
		}
	}
	public function getToDtTm(){
		if(isset($this->ToDtTm)){
			return $this->ToDtTm;
		}
	}
	
	// Create datetime (CreDtTm)
	public function setCreDtTm($CreDtTm){
		if(DataValidator::isDateTimeISOSyntaxValid($CreDtTm)){
			$this->CreDtTm = $CreDtTm;
		}
	}
	public function getCreDtTm(){
		if(isset($this->CreDtTm)){
			return $this->CreDtTm;
		}
	}
	
	// Entry reference number (sequence number)
	public function setNtryRef($NtryRef){
		if(DataValidator::isIntValid($NtryRef)){
			$this->NtryRef = $NtryRef;
		}
	}
	public function getNtryRef(){
		if(isset($this->NtryRef)){
			return $this->NtryRef;
		}
	}
	
	// Credit entries
	public function addCdtNtryNb(){
		$current = $this->getTtlCdtNtriesNb();
		$this->setTtlCdtNtriesNb($current+1);
	}
	public function setTtlCdtNtriesNb($TtlCdtNtriesNb){
		if(DataValidator::isIntValid($TtlCdtNtriesNb)){
			$this->TtlCdtNtriesNb = $TtlCdtNtriesNb;
		}
	}
	public function getTtlCdtNtriesNb(){
		if(isset($this->TtlCdtNtriesNb)) return $this->TtlCdtNtriesNb;
	}
	public function addCdtNtrySum($sum){
		$current = $this->getTtlCdtNtriesSum();
		$this->setTtlCdtNtriesSum($current+$sum);
	}
	public function setTtlCdtNtriesSum($TtlCdtNtriesSum){
		if(DataValidator::isNumericValid($TtlCdtNtriesSum)){
			$this->TtlCdtNtriesSum = $TtlCdtNtriesSum;
		}
	}
	public function getTtlCdtNtriesSum(){
		if(isset($this->TtlCdtNtriesSum)) return $this->TtlCdtNtriesSum;
	}
	
	// Debit entries
	public function addDbtNtryNb(){
		$current = $this->getTtlDbtNtriesNb();
		$this->setTtlDbtNtriesNb($current+1);
	}
	public function setTtlDbtNtriesNb($TtlDbtNtriesNb){
		if(DataValidator::isIntValid($TtlDbtNtriesNb)){
			$this->TtlDbtNtriesNb = $TtlDbtNtriesNb;
		}
	}
	public function getTtlDbtNtriesNb(){
		if(isset($this->TtlDbtNtriesNb)) return $this->TtlDbtNtriesNb;
	}
	public function addDbtNtrySum($sum){
		$current = $this->getTtlDbtNtriesSum();
		$this->setTtlDbtNtriesSum($current+$sum);
	}
	public function setTtlDbtNtriesSum($TtlDbtNtriesSum){
		if(DataValidator::isNumericValid($TtlDbtNtriesSum)){
			$this->TtlDbtNtriesSum = $TtlDbtNtriesSum;
		}
	}
	public function getTtlDbtNtriesSum(){
		if(isset($this->TtlDbtNtriesSum)) return $this->TtlDbtNtriesSum;
	}
	
	public function setFileName($fileName){
		if(is_string($fileName)){
			$this->fileName = $fileName;
		}
	}
	public function getFileName(){
		if(isset($this->fileName)){
			return $this->fileName;
		}
	}
	
	// ElctrncSeqNb
	public function setElctrncSeqNb($ElctrncSeqNb){
		if(DataValidator::isPositiveIntValid($ElctrncSeqNb)){
			$this->ElctrncSeqNb = $ElctrncSeqNb;
		}
	}
	public function getElctrncSeqNb(){
		if(isset($this->ElctrncSeqNb)){
			return $this->ElctrncSeqNb;
		}
	}
	
	// LglSeqNb
	public function setLglSeqNb($LglSeqNb){
		if(DataValidator::isPositiveIntValid($LglSeqNb)){
			$this->LglSeqNb = $LglSeqNb;
		}
	}
	public function getLglSeqNb(){
		if(isset($this->LglSeqNb)){
			return $this->LglSeqNb;
		}
	}
	
	public function getObjectVariables(){
		return get_object_vars($this);
	}
}