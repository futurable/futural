<?php

/**
 * This is the model class for table "res_users".
 *
 * The followings are the available columns in table 'res_users':
 * @property integer $id
 * @property boolean $active
 * @property string $login
 * @property string $password
 * @property integer $company_id
 * @property integer $partner_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $menu_id
 * @property string $login_date
 * @property string $signature
 * @property integer $action_id
 * @property integer $alias_id
 * @property boolean $share
 * @property integer $default_section_id
 *
 * The followings are the available model relations:
 * @property AccountAddtmplWizard[] $accountAddtmplWizards
 * @property AccountAddtmplWizard[] $accountAddtmplWizards1
 * @property AccountAccountType[] $accountAccountTypes
 * @property AccountAccountType[] $accountAccountTypes1
 * @property AccountAnalyticJournalReport[] $accountAnalyticJournalReports
 * @property AccountAnalyticJournalReport[] $accountAnalyticJournalReports1
 * @property AccountAnalyticBalance[] $accountAnalyticBalances
 * @property AccountAnalyticBalance[] $accountAnalyticBalances1
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles1
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountAnalyticLine[] $accountAnalyticLines1
 * @property AccountAnalyticLine[] $accountAnalyticLines2
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances1
 * @property AccountAnalyticChart[] $accountAnalyticCharts
 * @property AccountAnalyticChart[] $accountAnalyticCharts1
 * @property AccountAnalyticCostLedger[] $accountAnalyticCostLedgers
 * @property AccountAnalyticCostLedger[] $accountAnalyticCostLedgers1
 * @property AccountAnalyticJournal[] $accountAnalyticJournals
 * @property AccountAnalyticJournal[] $accountAnalyticJournals1
 * @property AccountAnalyticInvertedBalance[] $accountAnalyticInvertedBalances
 * @property AccountAnalyticInvertedBalance[] $accountAnalyticInvertedBalances1
 * @property AccountAnalyticCostLedgerJournalReport[] $accountAnalyticCostLedgerJournalReports
 * @property AccountAnalyticCostLedgerJournalReport[] $accountAnalyticCostLedgerJournalReports1
 * @property AccountBankStatement[] $accountBankStatements
 * @property AccountBankStatement[] $accountBankStatements1
 * @property AccountBankStatement[] $accountBankStatements2
 * @property AccountBalanceReport[] $accountBalanceReports
 * @property AccountBalanceReport[] $accountBalanceReports1
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards1
 * @property AccountChangeCurrency[] $accountChangeCurrencies
 * @property AccountChangeCurrency[] $accountChangeCurrencies1
 * @property AccountCommonAccountReport[] $accountCommonAccountReports
 * @property AccountCommonAccountReport[] $accountCommonAccountReports1
 * @property AccountConfigSettings[] $accountConfigSettings
 * @property AccountConfigSettings[] $accountConfigSettings1
 * @property AccountCentralJournal[] $accountCentralJournals
 * @property AccountCentralJournal[] $accountCentralJournals1
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountBankStatementLine[] $accountBankStatementLines1
 * @property AccountChart[] $accountCharts
 * @property AccountChart[] $accountCharts1
 * @property AccountCashboxLine[] $accountCashboxLines
 * @property AccountCashboxLine[] $accountCashboxLines1
 * @property AccountMove[] $accountMoves
 * @property AccountMove[] $accountMoves1
 * @property AccountCommonJournalReport[] $accountCommonJournalReports
 * @property AccountCommonJournalReport[] $accountCommonJournalReports1
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports1
 * @property AccountCommonReport[] $accountCommonReports
 * @property AccountCommonReport[] $accountCommonReports1
 * @property AccountChartTemplate[] $accountChartTemplates
 * @property AccountChartTemplate[] $accountChartTemplates1
 * @property AccountFiscalyearCloseState[] $accountFiscalyearCloseStates
 * @property AccountFiscalyearCloseState[] $accountFiscalyearCloseStates1
 * @property AccountFiscalPositionTaxTemplate[] $accountFiscalPositionTaxTemplates
 * @property AccountFiscalPositionTaxTemplate[] $accountFiscalPositionTaxTemplates1
 * @property AccountFiscalPositionTemplate[] $accountFiscalPositionTemplates
 * @property AccountFiscalPositionTemplate[] $accountFiscalPositionTemplates1
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountMoveLine[] $accountMoveLines1
 * @property AccountFiscalPosition[] $accountFiscalPositions
 * @property AccountFiscalPosition[] $accountFiscalPositions1
 * @property AccountPeriod[] $accountPeriods
 * @property AccountPeriod[] $accountPeriods1
 * @property AccountFiscalPositionTax[] $accountFiscalPositionTaxes
 * @property AccountFiscalPositionTax[] $accountFiscalPositionTaxes1
 * @property AccountGeneralJournal[] $accountGeneralJournals
 * @property AccountGeneralJournal[] $accountGeneralJournals1
 * @property AccountInvoice[] $accountInvoices
 * @property AccountInvoice[] $accountInvoices1
 * @property AccountInvoice[] $accountInvoices2
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses1
 * @property AccountInstaller[] $accountInstallers
 * @property AccountInstaller[] $accountInstallers1
 * @property AccountInvoiceCancel[] $accountInvoiceCancels
 * @property AccountInvoiceCancel[] $accountInvoiceCancels1
 * @property AccountInvoiceRefund[] $accountInvoiceRefunds
 * @property AccountInvoiceRefund[] $accountInvoiceRefunds1
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property AccountInvoiceTax[] $accountInvoiceTaxes1
 * @property AccountJournalPeriod[] $accountJournalPeriods
 * @property AccountJournalPeriod[] $accountJournalPeriods1
 * @property ResCurrencyRate[] $resCurrencyRates
 * @property ResCurrencyRate[] $resCurrencyRates1
 * @property AccountJournalCashboxLine[] $accountJournalCashboxLines
 * @property AccountJournalCashboxLine[] $accountJournalCashboxLines1
 * @property ProductTemplate[] $productTemplates
 * @property ProductTemplate[] $productTemplates1
 * @property ProductTemplate[] $productTemplates2
 * @property ProductUom[] $productUoms
 * @property ProductUom[] $productUoms1
 * @property AccountModel[] $accountModels
 * @property AccountModel[] $accountModels1
 * @property AccountInvoiceConfirm[] $accountInvoiceConfirms
 * @property AccountInvoiceConfirm[] $accountInvoiceConfirms1
 * @property AccountJournalSelect[] $accountJournalSelects
 * @property AccountJournalSelect[] $accountJournalSelects1
 * @property AccountMoveLineReconcileSelect[] $accountMoveLineReconcileSelects
 * @property AccountMoveLineReconcileSelect[] $accountMoveLineReconcileSelects1
 * @property AccountPartnerLedger[] $accountPartnerLedgers
 * @property AccountPartnerLedger[] $accountPartnerLedgers1
 * @property AccountPartnerReconcileProcess[] $accountPartnerReconcileProcesses
 * @property AccountPartnerReconcileProcess[] $accountPartnerReconcileProcesses1
 * @property AccountMoveBankReconcile[] $accountMoveBankReconciles
 * @property AccountMoveBankReconcile[] $accountMoveBankReconciles1
 * @property AccountModelLine[] $accountModelLines
 * @property AccountModelLine[] $accountModelLines1
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs1
 * @property AccountMoveReconcile[] $accountMoveReconciles
 * @property AccountMoveReconcile[] $accountMoveReconciles1
 * @property AccountMoveLineReconcile[] $accountMoveLineReconciles
 * @property AccountMoveLineReconcile[] $accountMoveLineReconciles1
 * @property AccountMoveLineUnreconcileSelect[] $accountMoveLineUnreconcileSelects
 * @property AccountMoveLineUnreconcileSelect[] $accountMoveLineUnreconcileSelects1
 * @property AccountOpenClosedFiscalyear[] $accountOpenClosedFiscalyears
 * @property AccountOpenClosedFiscalyear[] $accountOpenClosedFiscalyears1
 * @property AccountPartnerBalance[] $accountPartnerBalances
 * @property AccountPartnerBalance[] $accountPartnerBalances1
 * @property AccountPaymentTermLine[] $accountPaymentTermLines
 * @property AccountPaymentTermLine[] $accountPaymentTermLines1
 * @property AccountPeriodClose[] $accountPeriodCloses
 * @property AccountPeriodClose[] $accountPeriodCloses1
 * @property AccountSubscriptionLine[] $accountSubscriptionLines
 * @property AccountSubscriptionLine[] $accountSubscriptionLines1
 * @property AccountSubscription[] $accountSubscriptions
 * @property AccountSubscription[] $accountSubscriptions1
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears1
 * @property AccountTaxCodeTemplate[] $accountTaxCodeTemplates
 * @property AccountTaxCodeTemplate[] $accountTaxCodeTemplates1
 * @property AccountPrintJournal[] $accountPrintJournals
 * @property AccountPrintJournal[] $accountPrintJournals1
 * @property AccountStatementFromInvoiceLines[] $accountStatementFromInvoiceLines
 * @property AccountStatementFromInvoiceLines[] $accountStatementFromInvoiceLines1
 * @property AccountUseModel[] $accountUseModels
 * @property AccountUseModel[] $accountUseModels1
 * @property AccountTaxChart[] $accountTaxCharts
 * @property AccountTaxChart[] $accountTaxCharts1
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers1
 * @property AccountStateOpen[] $accountStateOpens
 * @property AccountStateOpen[] $accountStateOpens1
 * @property AccountSubscriptionGenerate[] $accountSubscriptionGenerates
 * @property AccountSubscriptionGenerate[] $accountSubscriptionGenerates1
 * @property AccountUnreconcile[] $accountUnreconciles
 * @property AccountUnreconcile[] $accountUnreconciles1
 * @property AccountUnreconcileReconcile[] $accountUnreconcileReconciles
 * @property AccountUnreconcileReconcile[] $accountUnreconcileReconciles1
 * @property AccountTaxCode[] $accountTaxCodes
 * @property AccountTaxCode[] $accountTaxCodes1
 * @property AccountingReport[] $accountingReports
 * @property AccountingReport[] $accountingReports1
 * @property AccountVoucherLine[] $accountVoucherLines
 * @property AccountVoucherLine[] $accountVoucherLines1
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property AccountVatDeclaration[] $accountVatDeclarations1
 * @property BaseConfigSettings[] $baseConfigSettings
 * @property BaseConfigSettings[] $baseConfigSettings1
 * @property BaseConfigSettings[] $baseConfigSettings2
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests1
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests2
 * @property BaseImportImport[] $baseImportImports
 * @property BaseImportImport[] $baseImportImports1
 * @property BaseImportTestsModelsChar[] $baseImportTestsModelsChars
 * @property BaseImportTestsModelsChar[] $baseImportTestsModelsChars1
 * @property BaseActionRule[] $baseActionRules
 * @property BaseActionRule[] $baseActionRules1
 * @property BaseActionRule[] $baseActionRules2
 * @property ActionTraceability[] $actionTraceabilities
 * @property ActionTraceability[] $actionTraceabilities1
 * @property AnalyticProfitEmpRel[] $analyticProfitEmpRels
 * @property BaseImportTestsModelsCharRequired[] $baseImportTestsModelsCharRequireds
 * @property BaseImportTestsModelsCharRequired[] $baseImportTestsModelsCharRequireds1
 * @property BaseImportTestsModelsCharStates[] $baseImportTestsModelsCharStates
 * @property BaseImportTestsModelsCharStates[] $baseImportTestsModelsCharStates1
 * @property BaseImportTestsModelsCharStillreadonly[] $baseImportTestsModelsCharStillreadonlies
 * @property BaseImportTestsModelsCharStillreadonly[] $baseImportTestsModelsCharStillreadonlies1
 * @property BaseImportTestsModelsPreview[] $baseImportTestsModelsPreviews
 * @property BaseImportTestsModelsPreview[] $baseImportTestsModelsPreviews1
 * @property BaseLanguageImport[] $baseLanguageImports
 * @property BaseLanguageImport[] $baseLanguageImports1
 * @property BaseLanguageInstall[] $baseLanguageInstalls
 * @property BaseLanguageInstall[] $baseLanguageInstalls1
 * @property BaseImportTestsModelsCharReadonly[] $baseImportTestsModelsCharReadonlies
 * @property BaseImportTestsModelsCharReadonly[] $baseImportTestsModelsCharReadonlies1
 * @property BaseImportTestsModelsO2mChild[] $baseImportTestsModelsO2mChildren
 * @property BaseImportTestsModelsO2mChild[] $baseImportTestsModelsO2mChildren1
 * @property BaseImportTestsModelsM2oRelated[] $baseImportTestsModelsM2oRelateds
 * @property BaseImportTestsModelsM2oRelated[] $baseImportTestsModelsM2oRelateds1
 * @property BaseImportTestsModelsO2m[] $baseImportTestsModelsO2ms
 * @property BaseImportTestsModelsO2m[] $baseImportTestsModelsO2ms1
 * @property BaseImportTestsModelsM2oRequiredRelated[] $baseImportTestsModelsM2oRequiredRelateds
 * @property BaseImportTestsModelsM2oRequiredRelated[] $baseImportTestsModelsM2oRequiredRelateds1
 * @property BaseLanguageExport[] $baseLanguageExports
 * @property BaseLanguageExport[] $baseLanguageExports1
 * @property BaseModuleConfiguration[] $baseModuleConfigurations
 * @property BaseModuleConfiguration[] $baseModuleConfigurations1
 * @property BaseModuleUpgrade[] $baseModuleUpgrades
 * @property BaseModuleUpgrade[] $baseModuleUpgrades1
 * @property BaseSetupTerminology[] $baseSetupTerminologies
 * @property BaseSetupTerminology[] $baseSetupTerminologies1
 * @property BaseUpdateTranslations[] $baseUpdateTranslations
 * @property BaseUpdateTranslations[] $baseUpdateTranslations1
 * @property BaseModuleUpdate[] $baseModuleUpdates
 * @property BaseModuleUpdate[] $baseModuleUpdates1
 * @property BoardCreate[] $boardCreates
 * @property BoardCreate[] $boardCreates1
 * @property CashBoxIn[] $cashBoxIns
 * @property CashBoxIn[] $cashBoxIns1
 * @property CalendarEvent[] $calendarEvents
 * @property CalendarEvent[] $calendarEvents1
 * @property CalendarEvent[] $calendarEvents2
 * @property CalendarEvent[] $calendarEvents3
 * @property BaseModuleImport[] $baseModuleImports
 * @property BaseModuleImport[] $baseModuleImports1
 * @property CalendarAttendee[] $calendarAttendees
 * @property CalendarAttendee[] $calendarAttendees1
 * @property CalendarAttendee[] $calendarAttendees2
 * @property CalendarTodo[] $calendarTodos
 * @property CalendarTodo[] $calendarTodos1
 * @property CalendarTodo[] $calendarTodos2
 * @property CalendarTodo[] $calendarTodos3
 * @property ChangeProductionQty[] $changeProductionQties
 * @property ChangeProductionQty[] $changeProductionQties1
 * @property CrmMeeting[] $crmMeetings
 * @property CrmMeeting[] $crmMeetings1
 * @property CrmMeeting[] $crmMeetings2
 * @property CrmMeeting[] $crmMeetings3
 * @property CrmCaseResourceType[] $crmCaseResourceTypes
 * @property CrmCaseResourceType[] $crmCaseResourceTypes1
 * @property CrmCaseChannel[] $crmCaseChannels
 * @property CrmCaseChannel[] $crmCaseChannels1
 * @property CrmCaseCateg[] $crmCaseCategs
 * @property CrmCaseCateg[] $crmCaseCategs1
 * @property CrmCaseStage[] $crmCaseStages
 * @property CrmCaseStage[] $crmCaseStages1
 * @property CrmLead[] $crmLeads
 * @property CrmLead[] $crmLeads1
 * @property CrmLead[] $crmLeads2
 * @property ChangePasswordWizard[] $changePasswordWizards
 * @property ChangePasswordWizard[] $changePasswordWizards1
 * @property CrmLead2opportunityPartnerMass[] $crmLead2opportunityPartnerMasses
 * @property CrmLead2opportunityPartnerMass[] $crmLead2opportunityPartnerMasses1
 * @property CrmLead2opportunityPartner[] $crmLead2opportunityPartners
 * @property CrmLead2opportunityPartner[] $crmLead2opportunityPartners1
 * @property CrmMakeSale[] $crmMakeSales
 * @property CrmMakeSale[] $crmMakeSales1
 * @property CrmSegmentation[] $crmSegmentations
 * @property CrmSegmentation[] $crmSegmentations1
 * @property CrmOpportunity2phonecall[] $crmOpportunity2phonecalls
 * @property CrmOpportunity2phonecall[] $crmOpportunity2phonecalls1
 * @property CrmOpportunity2phonecall[] $crmOpportunity2phonecalls2
 * @property CrmPhonecall2phonecall[] $crmPhonecall2phonecalls
 * @property CrmPhonecall2phonecall[] $crmPhonecall2phonecalls1
 * @property CrmPhonecall2phonecall[] $crmPhonecall2phonecalls2
 * @property CrmMeetingType[] $crmMeetingTypes
 * @property CrmMeetingType[] $crmMeetingTypes1
 * @property DecimalPrecision[] $decimalPrecisions
 * @property DecimalPrecision[] $decimalPrecisions1
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplate[] $emailTemplates1
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property EmailTemplatePreview[] $emailTemplatePreviews1
 * @property CrmPartnerBinding[] $crmPartnerBindings
 * @property CrmPartnerBinding[] $crmPartnerBindings1
 * @property CrmPhonecall[] $crmPhonecalls
 * @property CrmPhonecall[] $crmPhonecalls1
 * @property CrmPhonecall[] $crmPhonecalls2
 * @property CrmMergeOpportunity[] $crmMergeOpportunities
 * @property CrmMergeOpportunity[] $crmMergeOpportunities1
 * @property FetchmailConfigSettings[] $fetchmailConfigSettings
 * @property FetchmailConfigSettings[] $fetchmailConfigSettings1
 * @property HrJob[] $hrJobs
 * @property HrJob[] $hrJobs1
 * @property HrConfigSettings[] $hrConfigSettings
 * @property HrConfigSettings[] $hrConfigSettings1
 * @property HrSignInProject[] $hrSignInProjects
 * @property HrSignInProject[] $hrSignInProjects1
 * @property FetchmailServer[] $fetchmailServers
 * @property FetchmailServer[] $fetchmailServers1
 * @property HrAnalyticalTimesheetUsers[] $hrAnalyticalTimesheetUsers
 * @property HrAnalyticalTimesheetUsers[] $hrAnalyticalTimesheetUsers1
 * @property HrEmployee[] $hrEmployees
 * @property HrEmployee[] $hrEmployees1
 * @property HrActionReason[] $hrActionReasons
 * @property HrActionReason[] $hrActionReasons1
 * @property HrAnalyticTimesheet[] $hrAnalyticTimesheets
 * @property HrAnalyticTimesheet[] $hrAnalyticTimesheets1
 * @property HrAttendanceError[] $hrAttendanceErrors
 * @property HrAttendanceError[] $hrAttendanceErrors1
 * @property HrAttendanceMonth[] $hrAttendanceMonths
 * @property HrAttendanceMonth[] $hrAttendanceMonths1
 * @property HrAttendanceWeek[] $hrAttendanceWeeks
 * @property HrAttendanceWeek[] $hrAttendanceWeeks1
 * @property HrSignOutProject[] $hrSignOutProjects
 * @property HrSignOutProject[] $hrSignOutProjects1
 * @property HrDepartment[] $hrDepartments
 * @property HrDepartment[] $hrDepartments1
 * @property HrTimesheetCurrentOpen[] $hrTimesheetCurrentOpens
 * @property HrTimesheetCurrentOpen[] $hrTimesheetCurrentOpens1
 * @property IrActions[] $irActions
 * @property IrActions[] $irActions1
 * @property IrActWindowView[] $irActWindowViews
 * @property IrActWindowView[] $irActWindowViews1
 * @property IrActionsConfigurationWizard[] $irActionsConfigurationWizards
 * @property IrActionsConfigurationWizard[] $irActionsConfigurationWizards1
 * @property HrTimesheetInvoiceCreate[] $hrTimesheetInvoiceCreates
 * @property HrTimesheetInvoiceCreate[] $hrTimesheetInvoiceCreates1
 * @property HrTimesheetInvoiceCreateFinal[] $hrTimesheetInvoiceCreateFinals
 * @property HrTimesheetInvoiceCreateFinal[] $hrTimesheetInvoiceCreateFinals1
 * @property HrTimesheetSheetSheet[] $hrTimesheetSheetSheets
 * @property HrTimesheetSheetSheet[] $hrTimesheetSheetSheets1
 * @property IrConfigParameter[] $irConfigParameters
 * @property IrConfigParameter[] $irConfigParameters1
 * @property IrExports[] $irExports
 * @property IrExports[] $irExports1
 * @property IrMailServer[] $irMailServers
 * @property IrMailServer[] $irMailServers1
 * @property IrAttachment[] $irAttachments
 * @property IrAttachment[] $irAttachments1
 * @property IrCron[] $irCrons
 * @property IrCron[] $irCrons1
 * @property IrCron[] $irCrons2
 * @property IrModel[] $irModels
 * @property IrModel[] $irModels1
 * @property IrDefault[] $irDefaults
 * @property IrDefault[] $irDefaults1
 * @property IrDefault[] $irDefaults2
 * @property IrFieldsConverter[] $irFieldsConverters
 * @property IrFieldsConverter[] $irFieldsConverters1
 * @property IrModelFields[] $irModelFields
 * @property IrModelFields[] $irModelFields1
 * @property IrActionsTodo[] $irActionsTodos
 * @property IrActionsTodo[] $irActionsTodos1
 * @property IrProperty[] $irProperties
 * @property IrProperty[] $irProperties1
 * @property IrRule[] $irRules
 * @property IrRule[] $irRules1
 * @property IrModuleModuleDependency[] $irModuleModuleDependencies
 * @property IrModuleModuleDependency[] $irModuleModuleDependencies1
 * @property IrUiViewSc[] $irUiViewScs
 * @property IrUiViewSc[] $irUiViewScs1
 * @property IrUiViewSc[] $irUiViewScs2
 * @property IrServerObjectLines[] $irServerObjectLines
 * @property IrServerObjectLines[] $irServerObjectLines1
 * @property IrUiView[] $irUiViews
 * @property IrUiView[] $irUiViews1
 * @property IrValues[] $irValues
 * @property IrValues[] $irValues1
 * @property IrValues[] $irValues2
 * @property MailComposeMessage[] $mailComposeMessages
 * @property MailComposeMessage[] $mailComposeMessages1
 * @property IrSequenceType[] $irSequenceTypes
 * @property IrSequenceType[] $irSequenceTypes1
 * @property MailAlias[] $mailAliases
 * @property MailAlias[] $mailAliases1
 * @property MailAlias[] $mailAliases2
 * @property MailMessageSubtype[] $mailMessageSubtypes
 * @property MailMessageSubtype[] $mailMessageSubtypes1
 * @property MakeProcurement[] $makeProcurements
 * @property MakeProcurement[] $makeProcurements1
 * @property MrpBom[] $mrpBoms
 * @property MrpBom[] $mrpBoms1
 * @property MrpProductProduce[] $mrpProductProduces
 * @property MrpProductProduce[] $mrpProductProduces1
 * @property MailVote[] $mailVotes
 * @property MailWizardInvite[] $mailWizardInvites
 * @property MailWizardInvite[] $mailWizardInvites1
 * @property MrpConfigSettings[] $mrpConfigSettings
 * @property MrpConfigSettings[] $mrpConfigSettings1
 * @property MrpProductPrice[] $mrpProductPrices
 * @property MrpProductPrice[] $mrpProductPrices1
 * @property MrpPropertyGroup[] $mrpPropertyGroups
 * @property MrpPropertyGroup[] $mrpPropertyGroups1
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property MrpWorkcenter[] $mrpWorkcenters1
 * @property MrpRoutingWorkcenter[] $mrpRoutingWorkcenters
 * @property MrpRoutingWorkcenter[] $mrpRoutingWorkcenters1
 * @property MrpRouting[] $mrpRoutings
 * @property MrpRouting[] $mrpRoutings1
 * @property PricelistPartnerinfo[] $pricelistPartnerinfos
 * @property PricelistPartnerinfo[] $pricelistPartnerinfos1
 * @property MrpProductionWorkcenterLine[] $mrpProductionWorkcenterLines
 * @property MrpProductionWorkcenterLine[] $mrpProductionWorkcenterLines1
 * @property MrpWorkcenterLoad[] $mrpWorkcenterLoads
 * @property MrpWorkcenterLoad[] $mrpWorkcenterLoads1
 * @property MultiCompanyDefault[] $multiCompanyDefaults
 * @property MultiCompanyDefault[] $multiCompanyDefaults1
 * @property MrpProduction[] $mrpProductions
 * @property MrpProduction[] $mrpProductions1
 * @property MrpProduction[] $mrpProductions2
 * @property OsvMemoryAutovacuum[] $osvMemoryAutovacuums
 * @property OsvMemoryAutovacuum[] $osvMemoryAutovacuums1
 * @property ProcessCondition[] $processConditions
 * @property ProcessCondition[] $processConditions1
 * @property ProcurementOrder[] $procurementOrders
 * @property ProcurementOrder[] $procurementOrders1
 * @property ProductPricelistItem[] $productPricelistItems
 * @property ProductPricelistItem[] $productPricelistItems1
 * @property ProductPackaging[] $productPackagings
 * @property ProductPackaging[] $productPackagings1
 * @property ProcessTransition[] $processTransitions
 * @property ProcessTransition[] $processTransitions1
 * @property ProcessProcess[] $processProcesses
 * @property ProcessProcess[] $processProcesses1
 * @property ProcurementOrderComputeAll[] $procurementOrderComputeAlls
 * @property ProcurementOrderComputeAll[] $procurementOrderComputeAlls1
 * @property ProcurementOrderCompute[] $procurementOrderComputes
 * @property ProcurementOrderCompute[] $procurementOrderComputes1
 * @property ProcurementOrderpointCompute[] $procurementOrderpointComputes
 * @property ProcurementOrderpointCompute[] $procurementOrderpointComputes1
 * @property ProductPriceList[] $productPriceLists
 * @property ProductPriceList[] $productPriceLists1
 * @property ProductPriceType[] $productPriceTypes
 * @property ProductPriceType[] $productPriceTypes1
 * @property ProductCategory[] $productCategories
 * @property ProductCategory[] $productCategories1
 * @property ProductPricelistType[] $productPricelistTypes
 * @property ProductPricelistType[] $productPricelistTypes1
 * @property ProductUomCateg[] $productUomCategs
 * @property ProductUomCateg[] $productUomCategs1
 * @property ProjectTask[] $projectTasks
 * @property ProjectTask[] $projectTasks1
 * @property ProjectTask[] $projectTasks2
 * @property ProjectCategory[] $projectCategories
 * @property ProjectCategory[] $projectCategories1
 * @property ProjectProject[] $projectProjects
 * @property ProjectProject[] $projectProjects1
 * @property ProjectTaskReevaluate[] $projectTaskReevaluates
 * @property ProjectTaskReevaluate[] $projectTaskReevaluates1
 * @property ProductUl[] $productUls
 * @property ProductUl[] $productUls1
 * @property ProductPricelistVersion[] $productPricelistVersions
 * @property ProductPricelistVersion[] $productPricelistVersions1
 * @property ProjectTaskHistory[] $projectTaskHistories
 * @property ProjectAccountAnalyticLine[] $projectAccountAnalyticLines
 * @property ProjectAccountAnalyticLine[] $projectAccountAnalyticLines1
 * @property ProjectConfigSettings[] $projectConfigSettings
 * @property ProjectConfigSettings[] $projectConfigSettings1
 * @property PurchaseConfigSettings[] $purchaseConfigSettings
 * @property PurchaseConfigSettings[] $purchaseConfigSettings1
 * @property PurchaseOrderLineInvoice[] $purchaseOrderLineInvoices
 * @property PurchaseOrderLineInvoice[] $purchaseOrderLineInvoices1
 * @property ProjectTaskType[] $projectTaskTypes
 * @property ProjectTaskType[] $projectTaskTypes1
 * @property ProjectTaskWork[] $projectTaskWorks
 * @property ProjectTaskWork[] $projectTaskWorks1
 * @property ProjectTaskWork[] $projectTaskWorks2
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property PurchaseOrderLine[] $purchaseOrderLines1
 * @property ProjectUserRel[] $projectUserRels
 * @property PublisherWarrantyContract[] $publisherWarrantyContracts
 * @property PublisherWarrantyContract[] $publisherWarrantyContracts1
 * @property PurchaseOrderGroup[] $purchaseOrderGroups
 * @property PurchaseOrderGroup[] $purchaseOrderGroups1
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseOrder[] $purchaseOrders1
 * @property PurchaseOrder[] $purchaseOrders2
 * @property StockMove[] $stockMoves
 * @property StockMove[] $stockMoves1
 * @property TempRange[] $tempRanges
 * @property TempRange[] $tempRanges1
 * @property StockInventory[] $stockInventories
 * @property StockInventory[] $stockInventories1
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockInventoryLine[] $stockInventoryLines1
 * @property ResCountry[] $resCountries
 * @property ResCountry[] $resCountries1
 * @property StockPicking[] $stockPickings
 * @property StockPicking[] $stockPickings1
 * @property ResCompanyUsersRel[] $resCompanyUsersRels
 * @property ResAlarm[] $resAlarms
 * @property ResAlarm[] $resAlarms1
 * @property ResConfig[] $resConfigs
 * @property ResConfig[] $resConfigs1
 * @property ResConfigInstaller[] $resConfigInstallers
 * @property ResConfigInstaller[] $resConfigInstallers1
 * @property ResConfigSettings[] $resConfigSettings
 * @property ResConfigSettings[] $resConfigSettings1
 * @property ResGroupsUsersRel[] $resGroupsUsersRels
 * @property ResCurrencyRateType[] $resCurrencyRateTypes
 * @property ResCurrencyRateType[] $resCurrencyRateTypes1
 * @property ResLang[] $resLangs
 * @property ResLang[] $resLangs1
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResPartnerBank[] $resPartnerBanks1
 * @property ResRequestHistory[] $resRequestHistories
 * @property ResRequestHistory[] $resRequestHistories1
 * @property ResRequestHistory[] $resRequestHistories2
 * @property ResRequestHistory[] $resRequestHistories3
 * @property ResRequest[] $resRequests
 * @property ResRequest[] $resRequests1
 * @property ResRequest[] $resRequests2
 * @property ResRequest[] $resRequests3
 * @property ResourceCalendar[] $resourceCalendars
 * @property ResourceCalendar[] $resourceCalendars1
 * @property ResourceCalendar[] $resourceCalendars2
 * @property ResPartnerBankType[] $resPartnerBankTypes
 * @property ResPartnerBankType[] $resPartnerBankTypes1
 * @property ResPartnerCategory[] $resPartnerCategories
 * @property ResPartnerCategory[] $resPartnerCategories1
 * @property ResGroups[] $resGroups
 * @property ResGroups[] $resGroups1
 * @property ResPartnerBankTypeField[] $resPartnerBankTypeFields
 * @property ResPartnerBankTypeField[] $resPartnerBankTypeFields1
 * @property ResPartnerTitle[] $resPartnerTitles
 * @property ResPartnerTitle[] $resPartnerTitles1
 * @property ResRequestLink[] $resRequestLinks
 * @property ResRequestLink[] $resRequestLinks1
 * @property SaleConfigSettings[] $saleConfigSettings
 * @property SaleConfigSettings[] $saleConfigSettings1
 * @property SaleOrderLineMakeInvoice[] $saleOrderLineMakeInvoices
 * @property SaleOrderLineMakeInvoice[] $saleOrderLineMakeInvoices1
 * @property ShareWizard[] $shareWizards
 * @property ShareWizard[] $shareWizards1
 * @property ResourceResource[] $resourceResources
 * @property ResourceResource[] $resourceResources1
 * @property ResourceResource[] $resourceResources2
 * @property ResourceCalendarAttendance[] $resourceCalendarAttendances
 * @property ResourceCalendarAttendance[] $resourceCalendarAttendances1
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs1
 * @property SaleMakeInvoice[] $saleMakeInvoices
 * @property SaleMakeInvoice[] $saleMakeInvoices1
 * @property SaleMemberRel[] $saleMemberRels
 * @property SaleOrder[] $saleOrders
 * @property SaleOrder[] $saleOrders1
 * @property SaleOrder[] $saleOrders2
 * @property ShareWizardResultLine[] $shareWizardResultLines
 * @property ShareWizardResultLine[] $shareWizardResultLines1
 * @property ShareWizardResultLine[] $shareWizardResultLines2
 * @property SaleOrderLine[] $saleOrderLines
 * @property SaleOrderLine[] $saleOrderLines1
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockMoveConsume[] $stockMoveConsumes1
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits1
 * @property StockInvoiceOnshipping[] $stockInvoiceOnshippings
 * @property StockInvoiceOnshipping[] $stockInvoiceOnshippings1
 * @property StockLocationProduct[] $stockLocationProducts
 * @property StockLocationProduct[] $stockLocationProducts1
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockMoveScrap[] $stockMoveScraps1
 * @property StockJournal[] $stockJournals
 * @property StockJournal[] $stockJournals1
 * @property StockJournal[] $stockJournals2
 * @property StockFillInventory[] $stockFillInventories
 * @property StockFillInventory[] $stockFillInventories1
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockChangeProductQty[] $stockChangeProductQties1
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices1
 * @property StockConfigSettings[] $stockConfigSettings
 * @property StockConfigSettings[] $stockConfigSettings1
 * @property StockInventoryMerge[] $stockInventoryMerges
 * @property StockInventoryMerge[] $stockInventoryMerges1
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockPartialPickingLine[] $stockPartialPickingLines1
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories1
 * @property StockProductionLotRevision[] $stockProductionLotRevisions
 * @property StockProductionLotRevision[] $stockProductionLotRevisions1
 * @property StockProductionLotRevision[] $stockProductionLotRevisions2
 * @property StockReturnPicking[] $stockReturnPickings
 * @property StockReturnPicking[] $stockReturnPickings1
 * @property StockSplitInto[] $stockSplitIntos
 * @property StockSplitInto[] $stockSplitIntos1
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints1
 * @property StockMoveSplit[] $stockMoveSplits
 * @property StockMoveSplit[] $stockMoveSplits1
 * @property StockTracking[] $stockTrackings
 * @property StockTracking[] $stockTrackings1
 * @property StockPartialMove[] $stockPartialMoves
 * @property StockPartialMove[] $stockPartialMoves1
 * @property StockPartialPicking[] $stockPartialPickings
 * @property StockPartialPicking[] $stockPartialPickings1
 * @property WizardIrModelMenuCreate[] $wizardIrModelMenuCreates
 * @property WizardIrModelMenuCreate[] $wizardIrModelMenuCreates1
 * @property ValidateAccountMove[] $validateAccountMoves
 * @property ValidateAccountMove[] $validateAccountMoves1
 * @property ValidateAccountMoveLines[] $validateAccountMoveLines
 * @property ValidateAccountMoveLines[] $validateAccountMoveLines1
 * @property WkfLogs[] $wkfLogs
 * @property Wkf[] $wkfs
 * @property Wkf[] $wkfs1
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property AccountInvoiceLine[] $accountInvoiceLines1
 * @property AccountPaymentTerm[] $accountPaymentTerms
 * @property AccountPaymentTerm[] $accountPaymentTerms1
 * @property AccountTax[] $accountTaxes
 * @property AccountTax[] $accountTaxes1
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts1
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts2
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts3
 * @property AccountJournal[] $accountJournals
 * @property AccountJournal[] $accountJournals1
 * @property AccountJournal[] $accountJournals2
 * @property CrmCaseSection[] $crmCaseSections
 * @property CrmCaseSection[] $crmCaseSections1
 * @property CrmCaseSection[] $crmCaseSections2
 * @property AccountFiscalPositionAccountTemplate[] $accountFiscalPositionAccountTemplates
 * @property AccountFiscalPositionAccountTemplate[] $accountFiscalPositionAccountTemplates1
 * @property ResCompany[] $resCompanies
 * @property ResCompany[] $resCompanies1
 * @property IrFilters[] $irFilters
 * @property IrFilters[] $irFilters1
 * @property IrFilters[] $irFilters2
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts1
 * @property AccountAccountTemplate[] $accountAccountTemplates
 * @property AccountAccountTemplate[] $accountAccountTemplates1
 * @property AccountVoucher[] $accountVouchers
 * @property AccountVoucher[] $accountVouchers1
 * @property AccountAccount[] $accountAccounts
 * @property AccountAccount[] $accountAccounts1
 * @property IrUiMenu[] $irUiMenus
 * @property IrUiMenu[] $irUiMenus1
 * @property AccountFiscalyear[] $accountFiscalyears
 * @property AccountFiscalyear[] $accountFiscalyears1
 * @property CalendarAlarm[] $calendarAlarms
 * @property CalendarAlarm[] $calendarAlarms1
 * @property CalendarAlarm[] $calendarAlarms2
 * @property ResUsers $writeU
 * @property ResUsers[] $resUsers
 * @property ResPartner $partner
 * @property CrmCaseSection $defaultSection
 * @property ResUsers $createU
 * @property ResUsers[] $resUsers1
 * @property ResCompany $company
 * @property MailAlias $alias
 * @property BaseImportTestsModelsCharNoreadonly[] $baseImportTestsModelsCharNoreadonlies
 * @property BaseImportTestsModelsCharNoreadonly[] $baseImportTestsModelsCharNoreadonlies1
 * @property AccountFinancialReport[] $accountFinancialReports
 * @property AccountFinancialReport[] $accountFinancialReports1
 * @property ResPartner[] $resPartners
 * @property ResPartner[] $resPartners1
 * @property ResPartner[] $resPartners2
 * @property ProductPricelist[] $productPricelists
 * @property ProductPricelist[] $productPricelists1
 * @property AccountTaxTemplate[] $accountTaxTemplates
 * @property AccountTaxTemplate[] $accountTaxTemplates1
 * @property ResCurrency[] $resCurrencies
 * @property ResCurrency[] $resCurrencies1
 * @property ProductProduct[] $productProducts
 * @property ProductProduct[] $productProducts1
 * @property IrSequence[] $irSequences
 * @property IrSequence[] $irSequences1
 * @property BaseImportTestsModelsM2o[] $baseImportTestsModelsM2os
 * @property BaseImportTestsModelsM2o[] $baseImportTestsModelsM2os1
 * @property BaseImportTestsModelsM2oRequired[] $baseImportTestsModelsM2oRequireds
 * @property BaseImportTestsModelsM2oRequired[] $baseImportTestsModelsM2oRequireds1
 * @property HrTimesheetInvoiceFactor[] $hrTimesheetInvoiceFactors
 * @property HrTimesheetInvoiceFactor[] $hrTimesheetInvoiceFactors1
 * @property HrTimesheetAnalyticProfit[] $hrTimesheetAnalyticProfits
 * @property HrTimesheetAnalyticProfit[] $hrTimesheetAnalyticProfits1
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts1
 * @property CashBoxOut[] $cashBoxOuts
 * @property CashBoxOut[] $cashBoxOuts1
 * @property ProcessNode[] $processNodes
 * @property ProcessNode[] $processNodes1
 * @property ChangePasswordUser[] $changePasswordUsers
 * @property ChangePasswordUser[] $changePasswordUsers1
 * @property ChangePasswordUser[] $changePasswordUsers2
 * @property CrmLead2opportunityPartnerMassResUsersRel[] $crmLead2opportunityPartnerMassResUsersRels
 * @property MailMail[] $mailMails
 * @property MailMail[] $mailMails1
 * @property CrmPaymentMode[] $crmPaymentModes
 * @property CrmPaymentMode[] $crmPaymentModes1
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property MrpProductionProductLine[] $mrpProductionProductLines1
 * @property CrmSegmentationLine[] $crmSegmentationLines
 * @property CrmSegmentationLine[] $crmSegmentationLines1
 * @property HrAnalyticalTimesheetEmployee[] $hrAnalyticalTimesheetEmployees
 * @property HrAnalyticalTimesheetEmployee[] $hrAnalyticalTimesheetEmployees1
 * @property IrExportsLine[] $irExportsLines
 * @property IrExportsLine[] $irExportsLines1
 * @property ProductSupplierinfo[] $productSupplierinfos
 * @property ProductSupplierinfo[] $productSupplierinfos1
 * @property HrAttendance[] $hrAttendances
 * @property HrAttendance[] $hrAttendances1
 * @property IrModelAccess[] $irModelAccesses
 * @property IrModelAccess[] $irModelAccesses1
 * @property IrUiViewCustom[] $irUiViewCustoms
 * @property IrUiViewCustom[] $irUiViewCustoms1
 * @property IrUiViewCustom[] $irUiViewCustoms2
 * @property HrEmployeeCategory[] $hrEmployeeCategories
 * @property HrEmployeeCategory[] $hrEmployeeCategories1
 * @property MailMessage[] $mailMessages
 * @property MailMessage[] $mailMessages1
 * @property MailGroup[] $mailGroups
 * @property MailGroup[] $mailGroups1
 * @property ProcessTransitionAction[] $processTransitionActions
 * @property ProcessTransitionAction[] $processTransitionActions1
 * @property StockInventoryLineSplitLines[] $stockInventoryLineSplitLines
 * @property StockInventoryLineSplitLines[] $stockInventoryLineSplitLines1
 * @property ResBank[] $resBanks
 * @property ResBank[] $resBanks1
 * @property SaleShop[] $saleShops
 * @property SaleShop[] $saleShops1
 * @property IrModuleCategory[] $irModuleCategories
 * @property IrModuleCategory[] $irModuleCategories1
 * @property IrModuleModule[] $irModuleModules
 * @property IrModuleModule[] $irModuleModules1
 * @property ProjectTaskDelegate[] $projectTaskDelegates
 * @property ProjectTaskDelegate[] $projectTaskDelegates1
 * @property ProjectTaskDelegate[] $projectTaskDelegates2
 * @property ResourceCalendarLeaves[] $resourceCalendarLeaves
 * @property ResourceCalendarLeaves[] $resourceCalendarLeaves1
 * @property ResCountryState[] $resCountryStates
 * @property ResCountryState[] $resCountryStates1
 * @property StockLocation[] $stockLocations
 * @property StockLocation[] $stockLocations1
 * @property MrpProperty[] $mrpProperties
 * @property MrpProperty[] $mrpProperties1
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines1
 * @property StockIncoterms[] $stockIncoterms
 * @property StockIncoterms[] $stockIncoterms1
 * @property StockProductionLot[] $stockProductionLots
 * @property StockProductionLot[] $stockProductionLots1
 * @property StockMoveSplitLines[] $stockMoveSplitLines
 * @property StockMoveSplitLines[] $stockMoveSplitLines1
 * @property WkfTransition[] $wkfTransitions
 * @property WkfTransition[] $wkfTransitions1
 * @property StockWarehouse[] $stockWarehouses
 * @property StockWarehouse[] $stockWarehouses1
 * @property WkfActivity[] $wkfActivities
 * @property WkfActivity[] $wkfActivities1
 */
class ResUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, company_id, partner_id, alias_id', 'required'),
			array('company_id, partner_id, create_uid, write_uid, menu_id, action_id, alias_id, default_section_id', 'numerical', 'integerOnly'=>true),
			array('login, password', 'length', 'max'=>64),
			array('active, create_date, write_date, login_date, signature, share', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, login, password, company_id, partner_id, create_uid, create_date, write_date, write_uid, menu_id, login_date, signature, action_id, alias_id, share, default_section_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'accountAddtmplWizards' => array(self::HAS_MANY, 'AccountAddtmplWizard', 'write_uid'),
			'accountAddtmplWizards1' => array(self::HAS_MANY, 'AccountAddtmplWizard', 'create_uid'),
			'accountAccountTypes' => array(self::HAS_MANY, 'AccountAccountType', 'write_uid'),
			'accountAccountTypes1' => array(self::HAS_MANY, 'AccountAccountType', 'create_uid'),
			'accountAnalyticJournalReports' => array(self::HAS_MANY, 'AccountAnalyticJournalReport', 'write_uid'),
			'accountAnalyticJournalReports1' => array(self::HAS_MANY, 'AccountAnalyticJournalReport', 'create_uid'),
			'accountAnalyticBalances' => array(self::HAS_MANY, 'AccountAnalyticBalance', 'write_uid'),
			'accountAnalyticBalances1' => array(self::HAS_MANY, 'AccountAnalyticBalance', 'create_uid'),
			'accountAutomaticReconciles' => array(self::HAS_MANY, 'AccountAutomaticReconcile', 'write_uid'),
			'accountAutomaticReconciles1' => array(self::HAS_MANY, 'AccountAutomaticReconcile', 'create_uid'),
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'write_uid'),
			'accountAnalyticLines1' => array(self::HAS_MANY, 'AccountAnalyticLine', 'user_id'),
			'accountAnalyticLines2' => array(self::HAS_MANY, 'AccountAnalyticLine', 'create_uid'),
			'accountAgedTrialBalances' => array(self::HAS_MANY, 'AccountAgedTrialBalance', 'write_uid'),
			'accountAgedTrialBalances1' => array(self::HAS_MANY, 'AccountAgedTrialBalance', 'create_uid'),
			'accountAnalyticCharts' => array(self::HAS_MANY, 'AccountAnalyticChart', 'write_uid'),
			'accountAnalyticCharts1' => array(self::HAS_MANY, 'AccountAnalyticChart', 'create_uid'),
			'accountAnalyticCostLedgers' => array(self::HAS_MANY, 'AccountAnalyticCostLedger', 'write_uid'),
			'accountAnalyticCostLedgers1' => array(self::HAS_MANY, 'AccountAnalyticCostLedger', 'create_uid'),
			'accountAnalyticJournals' => array(self::HAS_MANY, 'AccountAnalyticJournal', 'write_uid'),
			'accountAnalyticJournals1' => array(self::HAS_MANY, 'AccountAnalyticJournal', 'create_uid'),
			'accountAnalyticInvertedBalances' => array(self::HAS_MANY, 'AccountAnalyticInvertedBalance', 'write_uid'),
			'accountAnalyticInvertedBalances1' => array(self::HAS_MANY, 'AccountAnalyticInvertedBalance', 'create_uid'),
			'accountAnalyticCostLedgerJournalReports' => array(self::HAS_MANY, 'AccountAnalyticCostLedgerJournalReport', 'write_uid'),
			'accountAnalyticCostLedgerJournalReports1' => array(self::HAS_MANY, 'AccountAnalyticCostLedgerJournalReport', 'create_uid'),
			'accountBankStatements' => array(self::HAS_MANY, 'AccountBankStatement', 'write_uid'),
			'accountBankStatements1' => array(self::HAS_MANY, 'AccountBankStatement', 'user_id'),
			'accountBankStatements2' => array(self::HAS_MANY, 'AccountBankStatement', 'create_uid'),
			'accountBalanceReports' => array(self::HAS_MANY, 'AccountBalanceReport', 'write_uid'),
			'accountBalanceReports1' => array(self::HAS_MANY, 'AccountBalanceReport', 'create_uid'),
			'accountBankAccountsWizards' => array(self::HAS_MANY, 'AccountBankAccountsWizard', 'write_uid'),
			'accountBankAccountsWizards1' => array(self::HAS_MANY, 'AccountBankAccountsWizard', 'create_uid'),
			'accountChangeCurrencies' => array(self::HAS_MANY, 'AccountChangeCurrency', 'write_uid'),
			'accountChangeCurrencies1' => array(self::HAS_MANY, 'AccountChangeCurrency', 'create_uid'),
			'accountCommonAccountReports' => array(self::HAS_MANY, 'AccountCommonAccountReport', 'write_uid'),
			'accountCommonAccountReports1' => array(self::HAS_MANY, 'AccountCommonAccountReport', 'create_uid'),
			'accountConfigSettings' => array(self::HAS_MANY, 'AccountConfigSettings', 'write_uid'),
			'accountConfigSettings1' => array(self::HAS_MANY, 'AccountConfigSettings', 'create_uid'),
			'accountCentralJournals' => array(self::HAS_MANY, 'AccountCentralJournal', 'write_uid'),
			'accountCentralJournals1' => array(self::HAS_MANY, 'AccountCentralJournal', 'create_uid'),
			'accountBankStatementLines' => array(self::HAS_MANY, 'AccountBankStatementLine', 'write_uid'),
			'accountBankStatementLines1' => array(self::HAS_MANY, 'AccountBankStatementLine', 'create_uid'),
			'accountCharts' => array(self::HAS_MANY, 'AccountChart', 'write_uid'),
			'accountCharts1' => array(self::HAS_MANY, 'AccountChart', 'create_uid'),
			'accountCashboxLines' => array(self::HAS_MANY, 'AccountCashboxLine', 'write_uid'),
			'accountCashboxLines1' => array(self::HAS_MANY, 'AccountCashboxLine', 'create_uid'),
			'accountMoves' => array(self::HAS_MANY, 'AccountMove', 'write_uid'),
			'accountMoves1' => array(self::HAS_MANY, 'AccountMove', 'create_uid'),
			'accountCommonJournalReports' => array(self::HAS_MANY, 'AccountCommonJournalReport', 'write_uid'),
			'accountCommonJournalReports1' => array(self::HAS_MANY, 'AccountCommonJournalReport', 'create_uid'),
			'accountCommonPartnerReports' => array(self::HAS_MANY, 'AccountCommonPartnerReport', 'write_uid'),
			'accountCommonPartnerReports1' => array(self::HAS_MANY, 'AccountCommonPartnerReport', 'create_uid'),
			'accountCommonReports' => array(self::HAS_MANY, 'AccountCommonReport', 'write_uid'),
			'accountCommonReports1' => array(self::HAS_MANY, 'AccountCommonReport', 'create_uid'),
			'accountChartTemplates' => array(self::HAS_MANY, 'AccountChartTemplate', 'write_uid'),
			'accountChartTemplates1' => array(self::HAS_MANY, 'AccountChartTemplate', 'create_uid'),
			'accountFiscalyearCloseStates' => array(self::HAS_MANY, 'AccountFiscalyearCloseState', 'write_uid'),
			'accountFiscalyearCloseStates1' => array(self::HAS_MANY, 'AccountFiscalyearCloseState', 'create_uid'),
			'accountFiscalPositionTaxTemplates' => array(self::HAS_MANY, 'AccountFiscalPositionTaxTemplate', 'write_uid'),
			'accountFiscalPositionTaxTemplates1' => array(self::HAS_MANY, 'AccountFiscalPositionTaxTemplate', 'create_uid'),
			'accountFiscalPositionTemplates' => array(self::HAS_MANY, 'AccountFiscalPositionTemplate', 'write_uid'),
			'accountFiscalPositionTemplates1' => array(self::HAS_MANY, 'AccountFiscalPositionTemplate', 'create_uid'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'write_uid'),
			'accountMoveLines1' => array(self::HAS_MANY, 'AccountMoveLine', 'create_uid'),
			'accountFiscalPositions' => array(self::HAS_MANY, 'AccountFiscalPosition', 'write_uid'),
			'accountFiscalPositions1' => array(self::HAS_MANY, 'AccountFiscalPosition', 'create_uid'),
			'accountPeriods' => array(self::HAS_MANY, 'AccountPeriod', 'write_uid'),
			'accountPeriods1' => array(self::HAS_MANY, 'AccountPeriod', 'create_uid'),
			'accountFiscalPositionTaxes' => array(self::HAS_MANY, 'AccountFiscalPositionTax', 'write_uid'),
			'accountFiscalPositionTaxes1' => array(self::HAS_MANY, 'AccountFiscalPositionTax', 'create_uid'),
			'accountGeneralJournals' => array(self::HAS_MANY, 'AccountGeneralJournal', 'write_uid'),
			'accountGeneralJournals1' => array(self::HAS_MANY, 'AccountGeneralJournal', 'create_uid'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'write_uid'),
			'accountInvoices1' => array(self::HAS_MANY, 'AccountInvoice', 'user_id'),
			'accountInvoices2' => array(self::HAS_MANY, 'AccountInvoice', 'create_uid'),
			'accountFiscalyearCloses' => array(self::HAS_MANY, 'AccountFiscalyearClose', 'write_uid'),
			'accountFiscalyearCloses1' => array(self::HAS_MANY, 'AccountFiscalyearClose', 'create_uid'),
			'accountInstallers' => array(self::HAS_MANY, 'AccountInstaller', 'write_uid'),
			'accountInstallers1' => array(self::HAS_MANY, 'AccountInstaller', 'create_uid'),
			'accountInvoiceCancels' => array(self::HAS_MANY, 'AccountInvoiceCancel', 'write_uid'),
			'accountInvoiceCancels1' => array(self::HAS_MANY, 'AccountInvoiceCancel', 'create_uid'),
			'accountInvoiceRefunds' => array(self::HAS_MANY, 'AccountInvoiceRefund', 'write_uid'),
			'accountInvoiceRefunds1' => array(self::HAS_MANY, 'AccountInvoiceRefund', 'create_uid'),
			'accountInvoiceTaxes' => array(self::HAS_MANY, 'AccountInvoiceTax', 'write_uid'),
			'accountInvoiceTaxes1' => array(self::HAS_MANY, 'AccountInvoiceTax', 'create_uid'),
			'accountJournalPeriods' => array(self::HAS_MANY, 'AccountJournalPeriod', 'write_uid'),
			'accountJournalPeriods1' => array(self::HAS_MANY, 'AccountJournalPeriod', 'create_uid'),
			'resCurrencyRates' => array(self::HAS_MANY, 'ResCurrencyRate', 'write_uid'),
			'resCurrencyRates1' => array(self::HAS_MANY, 'ResCurrencyRate', 'create_uid'),
			'accountJournalCashboxLines' => array(self::HAS_MANY, 'AccountJournalCashboxLine', 'write_uid'),
			'accountJournalCashboxLines1' => array(self::HAS_MANY, 'AccountJournalCashboxLine', 'create_uid'),
			'productTemplates' => array(self::HAS_MANY, 'ProductTemplate', 'write_uid'),
			'productTemplates1' => array(self::HAS_MANY, 'ProductTemplate', 'product_manager'),
			'productTemplates2' => array(self::HAS_MANY, 'ProductTemplate', 'create_uid'),
			'productUoms' => array(self::HAS_MANY, 'ProductUom', 'write_uid'),
			'productUoms1' => array(self::HAS_MANY, 'ProductUom', 'create_uid'),
			'accountModels' => array(self::HAS_MANY, 'AccountModel', 'write_uid'),
			'accountModels1' => array(self::HAS_MANY, 'AccountModel', 'create_uid'),
			'accountInvoiceConfirms' => array(self::HAS_MANY, 'AccountInvoiceConfirm', 'write_uid'),
			'accountInvoiceConfirms1' => array(self::HAS_MANY, 'AccountInvoiceConfirm', 'create_uid'),
			'accountJournalSelects' => array(self::HAS_MANY, 'AccountJournalSelect', 'write_uid'),
			'accountJournalSelects1' => array(self::HAS_MANY, 'AccountJournalSelect', 'create_uid'),
			'accountMoveLineReconcileSelects' => array(self::HAS_MANY, 'AccountMoveLineReconcileSelect', 'write_uid'),
			'accountMoveLineReconcileSelects1' => array(self::HAS_MANY, 'AccountMoveLineReconcileSelect', 'create_uid'),
			'accountPartnerLedgers' => array(self::HAS_MANY, 'AccountPartnerLedger', 'write_uid'),
			'accountPartnerLedgers1' => array(self::HAS_MANY, 'AccountPartnerLedger', 'create_uid'),
			'accountPartnerReconcileProcesses' => array(self::HAS_MANY, 'AccountPartnerReconcileProcess', 'write_uid'),
			'accountPartnerReconcileProcesses1' => array(self::HAS_MANY, 'AccountPartnerReconcileProcess', 'create_uid'),
			'accountMoveBankReconciles' => array(self::HAS_MANY, 'AccountMoveBankReconcile', 'write_uid'),
			'accountMoveBankReconciles1' => array(self::HAS_MANY, 'AccountMoveBankReconcile', 'create_uid'),
			'accountModelLines' => array(self::HAS_MANY, 'AccountModelLine', 'write_uid'),
			'accountModelLines1' => array(self::HAS_MANY, 'AccountModelLine', 'create_uid'),
			'accountMoveLineReconcileWriteoffs' => array(self::HAS_MANY, 'AccountMoveLineReconcileWriteoff', 'write_uid'),
			'accountMoveLineReconcileWriteoffs1' => array(self::HAS_MANY, 'AccountMoveLineReconcileWriteoff', 'create_uid'),
			'accountMoveReconciles' => array(self::HAS_MANY, 'AccountMoveReconcile', 'write_uid'),
			'accountMoveReconciles1' => array(self::HAS_MANY, 'AccountMoveReconcile', 'create_uid'),
			'accountMoveLineReconciles' => array(self::HAS_MANY, 'AccountMoveLineReconcile', 'write_uid'),
			'accountMoveLineReconciles1' => array(self::HAS_MANY, 'AccountMoveLineReconcile', 'create_uid'),
			'accountMoveLineUnreconcileSelects' => array(self::HAS_MANY, 'AccountMoveLineUnreconcileSelect', 'write_uid'),
			'accountMoveLineUnreconcileSelects1' => array(self::HAS_MANY, 'AccountMoveLineUnreconcileSelect', 'create_uid'),
			'accountOpenClosedFiscalyears' => array(self::HAS_MANY, 'AccountOpenClosedFiscalyear', 'write_uid'),
			'accountOpenClosedFiscalyears1' => array(self::HAS_MANY, 'AccountOpenClosedFiscalyear', 'create_uid'),
			'accountPartnerBalances' => array(self::HAS_MANY, 'AccountPartnerBalance', 'write_uid'),
			'accountPartnerBalances1' => array(self::HAS_MANY, 'AccountPartnerBalance', 'create_uid'),
			'accountPaymentTermLines' => array(self::HAS_MANY, 'AccountPaymentTermLine', 'write_uid'),
			'accountPaymentTermLines1' => array(self::HAS_MANY, 'AccountPaymentTermLine', 'create_uid'),
			'accountPeriodCloses' => array(self::HAS_MANY, 'AccountPeriodClose', 'write_uid'),
			'accountPeriodCloses1' => array(self::HAS_MANY, 'AccountPeriodClose', 'create_uid'),
			'accountSubscriptionLines' => array(self::HAS_MANY, 'AccountSubscriptionLine', 'write_uid'),
			'accountSubscriptionLines1' => array(self::HAS_MANY, 'AccountSubscriptionLine', 'create_uid'),
			'accountSubscriptions' => array(self::HAS_MANY, 'AccountSubscription', 'write_uid'),
			'accountSubscriptions1' => array(self::HAS_MANY, 'AccountSubscription', 'create_uid'),
			'accountSequenceFiscalyears' => array(self::HAS_MANY, 'AccountSequenceFiscalyear', 'write_uid'),
			'accountSequenceFiscalyears1' => array(self::HAS_MANY, 'AccountSequenceFiscalyear', 'create_uid'),
			'accountTaxCodeTemplates' => array(self::HAS_MANY, 'AccountTaxCodeTemplate', 'write_uid'),
			'accountTaxCodeTemplates1' => array(self::HAS_MANY, 'AccountTaxCodeTemplate', 'create_uid'),
			'accountPrintJournals' => array(self::HAS_MANY, 'AccountPrintJournal', 'write_uid'),
			'accountPrintJournals1' => array(self::HAS_MANY, 'AccountPrintJournal', 'create_uid'),
			'accountStatementFromInvoiceLines' => array(self::HAS_MANY, 'AccountStatementFromInvoiceLines', 'write_uid'),
			'accountStatementFromInvoiceLines1' => array(self::HAS_MANY, 'AccountStatementFromInvoiceLines', 'create_uid'),
			'accountUseModels' => array(self::HAS_MANY, 'AccountUseModel', 'write_uid'),
			'accountUseModels1' => array(self::HAS_MANY, 'AccountUseModel', 'create_uid'),
			'accountTaxCharts' => array(self::HAS_MANY, 'AccountTaxChart', 'write_uid'),
			'accountTaxCharts1' => array(self::HAS_MANY, 'AccountTaxChart', 'create_uid'),
			'accountReportGeneralLedgers' => array(self::HAS_MANY, 'AccountReportGeneralLedger', 'write_uid'),
			'accountReportGeneralLedgers1' => array(self::HAS_MANY, 'AccountReportGeneralLedger', 'create_uid'),
			'accountStateOpens' => array(self::HAS_MANY, 'AccountStateOpen', 'write_uid'),
			'accountStateOpens1' => array(self::HAS_MANY, 'AccountStateOpen', 'create_uid'),
			'accountSubscriptionGenerates' => array(self::HAS_MANY, 'AccountSubscriptionGenerate', 'write_uid'),
			'accountSubscriptionGenerates1' => array(self::HAS_MANY, 'AccountSubscriptionGenerate', 'create_uid'),
			'accountUnreconciles' => array(self::HAS_MANY, 'AccountUnreconcile', 'write_uid'),
			'accountUnreconciles1' => array(self::HAS_MANY, 'AccountUnreconcile', 'create_uid'),
			'accountUnreconcileReconciles' => array(self::HAS_MANY, 'AccountUnreconcileReconcile', 'write_uid'),
			'accountUnreconcileReconciles1' => array(self::HAS_MANY, 'AccountUnreconcileReconcile', 'create_uid'),
			'accountTaxCodes' => array(self::HAS_MANY, 'AccountTaxCode', 'write_uid'),
			'accountTaxCodes1' => array(self::HAS_MANY, 'AccountTaxCode', 'create_uid'),
			'accountingReports' => array(self::HAS_MANY, 'AccountingReport', 'write_uid'),
			'accountingReports1' => array(self::HAS_MANY, 'AccountingReport', 'create_uid'),
			'accountVoucherLines' => array(self::HAS_MANY, 'AccountVoucherLine', 'write_uid'),
			'accountVoucherLines1' => array(self::HAS_MANY, 'AccountVoucherLine', 'create_uid'),
			'accountVatDeclarations' => array(self::HAS_MANY, 'AccountVatDeclaration', 'write_uid'),
			'accountVatDeclarations1' => array(self::HAS_MANY, 'AccountVatDeclaration', 'create_uid'),
			'baseConfigSettings' => array(self::HAS_MANY, 'BaseConfigSettings', 'write_uid'),
			'baseConfigSettings1' => array(self::HAS_MANY, 'BaseConfigSettings', 'create_uid'),
			'baseConfigSettings2' => array(self::HAS_MANY, 'BaseConfigSettings', 'auth_signup_template_user_id'),
			'baseActionRuleLeadTests' => array(self::HAS_MANY, 'BaseActionRuleLeadTest', 'write_uid'),
			'baseActionRuleLeadTests1' => array(self::HAS_MANY, 'BaseActionRuleLeadTest', 'user_id'),
			'baseActionRuleLeadTests2' => array(self::HAS_MANY, 'BaseActionRuleLeadTest', 'create_uid'),
			'baseImportImports' => array(self::HAS_MANY, 'BaseImportImport', 'write_uid'),
			'baseImportImports1' => array(self::HAS_MANY, 'BaseImportImport', 'create_uid'),
			'baseImportTestsModelsChars' => array(self::HAS_MANY, 'BaseImportTestsModelsChar', 'write_uid'),
			'baseImportTestsModelsChars1' => array(self::HAS_MANY, 'BaseImportTestsModelsChar', 'create_uid'),
			'baseActionRules' => array(self::HAS_MANY, 'BaseActionRule', 'write_uid'),
			'baseActionRules1' => array(self::HAS_MANY, 'BaseActionRule', 'create_uid'),
			'baseActionRules2' => array(self::HAS_MANY, 'BaseActionRule', 'act_user_id'),
			'actionTraceabilities' => array(self::HAS_MANY, 'ActionTraceability', 'write_uid'),
			'actionTraceabilities1' => array(self::HAS_MANY, 'ActionTraceability', 'create_uid'),
			'analyticProfitEmpRels' => array(self::HAS_MANY, 'AnalyticProfitEmpRel', 'emp_id'),
			'baseImportTestsModelsCharRequireds' => array(self::HAS_MANY, 'BaseImportTestsModelsCharRequired', 'write_uid'),
			'baseImportTestsModelsCharRequireds1' => array(self::HAS_MANY, 'BaseImportTestsModelsCharRequired', 'create_uid'),
			'baseImportTestsModelsCharStates' => array(self::HAS_MANY, 'BaseImportTestsModelsCharStates', 'write_uid'),
			'baseImportTestsModelsCharStates1' => array(self::HAS_MANY, 'BaseImportTestsModelsCharStates', 'create_uid'),
			'baseImportTestsModelsCharStillreadonlies' => array(self::HAS_MANY, 'BaseImportTestsModelsCharStillreadonly', 'write_uid'),
			'baseImportTestsModelsCharStillreadonlies1' => array(self::HAS_MANY, 'BaseImportTestsModelsCharStillreadonly', 'create_uid'),
			'baseImportTestsModelsPreviews' => array(self::HAS_MANY, 'BaseImportTestsModelsPreview', 'write_uid'),
			'baseImportTestsModelsPreviews1' => array(self::HAS_MANY, 'BaseImportTestsModelsPreview', 'create_uid'),
			'baseLanguageImports' => array(self::HAS_MANY, 'BaseLanguageImport', 'write_uid'),
			'baseLanguageImports1' => array(self::HAS_MANY, 'BaseLanguageImport', 'create_uid'),
			'baseLanguageInstalls' => array(self::HAS_MANY, 'BaseLanguageInstall', 'write_uid'),
			'baseLanguageInstalls1' => array(self::HAS_MANY, 'BaseLanguageInstall', 'create_uid'),
			'baseImportTestsModelsCharReadonlies' => array(self::HAS_MANY, 'BaseImportTestsModelsCharReadonly', 'write_uid'),
			'baseImportTestsModelsCharReadonlies1' => array(self::HAS_MANY, 'BaseImportTestsModelsCharReadonly', 'create_uid'),
			'baseImportTestsModelsO2mChildren' => array(self::HAS_MANY, 'BaseImportTestsModelsO2mChild', 'write_uid'),
			'baseImportTestsModelsO2mChildren1' => array(self::HAS_MANY, 'BaseImportTestsModelsO2mChild', 'create_uid'),
			'baseImportTestsModelsM2oRelateds' => array(self::HAS_MANY, 'BaseImportTestsModelsM2oRelated', 'write_uid'),
			'baseImportTestsModelsM2oRelateds1' => array(self::HAS_MANY, 'BaseImportTestsModelsM2oRelated', 'create_uid'),
			'baseImportTestsModelsO2ms' => array(self::HAS_MANY, 'BaseImportTestsModelsO2m', 'write_uid'),
			'baseImportTestsModelsO2ms1' => array(self::HAS_MANY, 'BaseImportTestsModelsO2m', 'create_uid'),
			'baseImportTestsModelsM2oRequiredRelateds' => array(self::HAS_MANY, 'BaseImportTestsModelsM2oRequiredRelated', 'write_uid'),
			'baseImportTestsModelsM2oRequiredRelateds1' => array(self::HAS_MANY, 'BaseImportTestsModelsM2oRequiredRelated', 'create_uid'),
			'baseLanguageExports' => array(self::HAS_MANY, 'BaseLanguageExport', 'write_uid'),
			'baseLanguageExports1' => array(self::HAS_MANY, 'BaseLanguageExport', 'create_uid'),
			'baseModuleConfigurations' => array(self::HAS_MANY, 'BaseModuleConfiguration', 'write_uid'),
			'baseModuleConfigurations1' => array(self::HAS_MANY, 'BaseModuleConfiguration', 'create_uid'),
			'baseModuleUpgrades' => array(self::HAS_MANY, 'BaseModuleUpgrade', 'write_uid'),
			'baseModuleUpgrades1' => array(self::HAS_MANY, 'BaseModuleUpgrade', 'create_uid'),
			'baseSetupTerminologies' => array(self::HAS_MANY, 'BaseSetupTerminology', 'write_uid'),
			'baseSetupTerminologies1' => array(self::HAS_MANY, 'BaseSetupTerminology', 'create_uid'),
			'baseUpdateTranslations' => array(self::HAS_MANY, 'BaseUpdateTranslations', 'write_uid'),
			'baseUpdateTranslations1' => array(self::HAS_MANY, 'BaseUpdateTranslations', 'create_uid'),
			'baseModuleUpdates' => array(self::HAS_MANY, 'BaseModuleUpdate', 'write_uid'),
			'baseModuleUpdates1' => array(self::HAS_MANY, 'BaseModuleUpdate', 'create_uid'),
			'boardCreates' => array(self::HAS_MANY, 'BoardCreate', 'write_uid'),
			'boardCreates1' => array(self::HAS_MANY, 'BoardCreate', 'create_uid'),
			'cashBoxIns' => array(self::HAS_MANY, 'CashBoxIn', 'write_uid'),
			'cashBoxIns1' => array(self::HAS_MANY, 'CashBoxIn', 'create_uid'),
			'calendarEvents' => array(self::HAS_MANY, 'CalendarEvent', 'write_uid'),
			'calendarEvents1' => array(self::HAS_MANY, 'CalendarEvent', 'user_id'),
			'calendarEvents2' => array(self::HAS_MANY, 'CalendarEvent', 'organizer_id'),
			'calendarEvents3' => array(self::HAS_MANY, 'CalendarEvent', 'create_uid'),
			'baseModuleImports' => array(self::HAS_MANY, 'BaseModuleImport', 'write_uid'),
			'baseModuleImports1' => array(self::HAS_MANY, 'BaseModuleImport', 'create_uid'),
			'calendarAttendees' => array(self::HAS_MANY, 'CalendarAttendee', 'write_uid'),
			'calendarAttendees1' => array(self::HAS_MANY, 'CalendarAttendee', 'user_id'),
			'calendarAttendees2' => array(self::HAS_MANY, 'CalendarAttendee', 'create_uid'),
			'calendarTodos' => array(self::HAS_MANY, 'CalendarTodo', 'write_uid'),
			'calendarTodos1' => array(self::HAS_MANY, 'CalendarTodo', 'user_id'),
			'calendarTodos2' => array(self::HAS_MANY, 'CalendarTodo', 'organizer_id'),
			'calendarTodos3' => array(self::HAS_MANY, 'CalendarTodo', 'create_uid'),
			'changeProductionQties' => array(self::HAS_MANY, 'ChangeProductionQty', 'write_uid'),
			'changeProductionQties1' => array(self::HAS_MANY, 'ChangeProductionQty', 'create_uid'),
			'crmMeetings' => array(self::HAS_MANY, 'CrmMeeting', 'write_uid'),
			'crmMeetings1' => array(self::HAS_MANY, 'CrmMeeting', 'user_id'),
			'crmMeetings2' => array(self::HAS_MANY, 'CrmMeeting', 'organizer_id'),
			'crmMeetings3' => array(self::HAS_MANY, 'CrmMeeting', 'create_uid'),
			'crmCaseResourceTypes' => array(self::HAS_MANY, 'CrmCaseResourceType', 'write_uid'),
			'crmCaseResourceTypes1' => array(self::HAS_MANY, 'CrmCaseResourceType', 'create_uid'),
			'crmCaseChannels' => array(self::HAS_MANY, 'CrmCaseChannel', 'write_uid'),
			'crmCaseChannels1' => array(self::HAS_MANY, 'CrmCaseChannel', 'create_uid'),
			'crmCaseCategs' => array(self::HAS_MANY, 'CrmCaseCateg', 'write_uid'),
			'crmCaseCategs1' => array(self::HAS_MANY, 'CrmCaseCateg', 'create_uid'),
			'crmCaseStages' => array(self::HAS_MANY, 'CrmCaseStage', 'write_uid'),
			'crmCaseStages1' => array(self::HAS_MANY, 'CrmCaseStage', 'create_uid'),
			'crmLeads' => array(self::HAS_MANY, 'CrmLead', 'write_uid'),
			'crmLeads1' => array(self::HAS_MANY, 'CrmLead', 'user_id'),
			'crmLeads2' => array(self::HAS_MANY, 'CrmLead', 'create_uid'),
			'changePasswordWizards' => array(self::HAS_MANY, 'ChangePasswordWizard', 'write_uid'),
			'changePasswordWizards1' => array(self::HAS_MANY, 'ChangePasswordWizard', 'create_uid'),
			'crmLead2opportunityPartnerMasses' => array(self::HAS_MANY, 'CrmLead2opportunityPartnerMass', 'write_uid'),
			'crmLead2opportunityPartnerMasses1' => array(self::HAS_MANY, 'CrmLead2opportunityPartnerMass', 'create_uid'),
			'crmLead2opportunityPartners' => array(self::HAS_MANY, 'CrmLead2opportunityPartner', 'write_uid'),
			'crmLead2opportunityPartners1' => array(self::HAS_MANY, 'CrmLead2opportunityPartner', 'create_uid'),
			'crmMakeSales' => array(self::HAS_MANY, 'CrmMakeSale', 'write_uid'),
			'crmMakeSales1' => array(self::HAS_MANY, 'CrmMakeSale', 'create_uid'),
			'crmSegmentations' => array(self::HAS_MANY, 'CrmSegmentation', 'write_uid'),
			'crmSegmentations1' => array(self::HAS_MANY, 'CrmSegmentation', 'create_uid'),
			'crmOpportunity2phonecalls' => array(self::HAS_MANY, 'CrmOpportunity2phonecall', 'write_uid'),
			'crmOpportunity2phonecalls1' => array(self::HAS_MANY, 'CrmOpportunity2phonecall', 'user_id'),
			'crmOpportunity2phonecalls2' => array(self::HAS_MANY, 'CrmOpportunity2phonecall', 'create_uid'),
			'crmPhonecall2phonecalls' => array(self::HAS_MANY, 'CrmPhonecall2phonecall', 'write_uid'),
			'crmPhonecall2phonecalls1' => array(self::HAS_MANY, 'CrmPhonecall2phonecall', 'user_id'),
			'crmPhonecall2phonecalls2' => array(self::HAS_MANY, 'CrmPhonecall2phonecall', 'create_uid'),
			'crmMeetingTypes' => array(self::HAS_MANY, 'CrmMeetingType', 'write_uid'),
			'crmMeetingTypes1' => array(self::HAS_MANY, 'CrmMeetingType', 'create_uid'),
			'decimalPrecisions' => array(self::HAS_MANY, 'DecimalPrecision', 'write_uid'),
			'decimalPrecisions1' => array(self::HAS_MANY, 'DecimalPrecision', 'create_uid'),
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'write_uid'),
			'emailTemplates1' => array(self::HAS_MANY, 'EmailTemplate', 'create_uid'),
			'emailTemplatePreviews' => array(self::HAS_MANY, 'EmailTemplatePreview', 'write_uid'),
			'emailTemplatePreviews1' => array(self::HAS_MANY, 'EmailTemplatePreview', 'create_uid'),
			'crmPartnerBindings' => array(self::HAS_MANY, 'CrmPartnerBinding', 'write_uid'),
			'crmPartnerBindings1' => array(self::HAS_MANY, 'CrmPartnerBinding', 'create_uid'),
			'crmPhonecalls' => array(self::HAS_MANY, 'CrmPhonecall', 'write_uid'),
			'crmPhonecalls1' => array(self::HAS_MANY, 'CrmPhonecall', 'user_id'),
			'crmPhonecalls2' => array(self::HAS_MANY, 'CrmPhonecall', 'create_uid'),
			'crmMergeOpportunities' => array(self::HAS_MANY, 'CrmMergeOpportunity', 'write_uid'),
			'crmMergeOpportunities1' => array(self::HAS_MANY, 'CrmMergeOpportunity', 'create_uid'),
			'fetchmailConfigSettings' => array(self::HAS_MANY, 'FetchmailConfigSettings', 'write_uid'),
			'fetchmailConfigSettings1' => array(self::HAS_MANY, 'FetchmailConfigSettings', 'create_uid'),
			'hrJobs' => array(self::HAS_MANY, 'HrJob', 'write_uid'),
			'hrJobs1' => array(self::HAS_MANY, 'HrJob', 'create_uid'),
			'hrConfigSettings' => array(self::HAS_MANY, 'HrConfigSettings', 'write_uid'),
			'hrConfigSettings1' => array(self::HAS_MANY, 'HrConfigSettings', 'create_uid'),
			'hrSignInProjects' => array(self::HAS_MANY, 'HrSignInProject', 'write_uid'),
			'hrSignInProjects1' => array(self::HAS_MANY, 'HrSignInProject', 'create_uid'),
			'fetchmailServers' => array(self::HAS_MANY, 'FetchmailServer', 'write_uid'),
			'fetchmailServers1' => array(self::HAS_MANY, 'FetchmailServer', 'create_uid'),
			'hrAnalyticalTimesheetUsers' => array(self::HAS_MANY, 'HrAnalyticalTimesheetUsers', 'write_uid'),
			'hrAnalyticalTimesheetUsers1' => array(self::HAS_MANY, 'HrAnalyticalTimesheetUsers', 'create_uid'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'write_uid'),
			'hrEmployees1' => array(self::HAS_MANY, 'HrEmployee', 'create_uid'),
			'hrActionReasons' => array(self::HAS_MANY, 'HrActionReason', 'write_uid'),
			'hrActionReasons1' => array(self::HAS_MANY, 'HrActionReason', 'create_uid'),
			'hrAnalyticTimesheets' => array(self::HAS_MANY, 'HrAnalyticTimesheet', 'write_uid'),
			'hrAnalyticTimesheets1' => array(self::HAS_MANY, 'HrAnalyticTimesheet', 'create_uid'),
			'hrAttendanceErrors' => array(self::HAS_MANY, 'HrAttendanceError', 'write_uid'),
			'hrAttendanceErrors1' => array(self::HAS_MANY, 'HrAttendanceError', 'create_uid'),
			'hrAttendanceMonths' => array(self::HAS_MANY, 'HrAttendanceMonth', 'write_uid'),
			'hrAttendanceMonths1' => array(self::HAS_MANY, 'HrAttendanceMonth', 'create_uid'),
			'hrAttendanceWeeks' => array(self::HAS_MANY, 'HrAttendanceWeek', 'write_uid'),
			'hrAttendanceWeeks1' => array(self::HAS_MANY, 'HrAttendanceWeek', 'create_uid'),
			'hrSignOutProjects' => array(self::HAS_MANY, 'HrSignOutProject', 'write_uid'),
			'hrSignOutProjects1' => array(self::HAS_MANY, 'HrSignOutProject', 'create_uid'),
			'hrDepartments' => array(self::HAS_MANY, 'HrDepartment', 'write_uid'),
			'hrDepartments1' => array(self::HAS_MANY, 'HrDepartment', 'create_uid'),
			'hrTimesheetCurrentOpens' => array(self::HAS_MANY, 'HrTimesheetCurrentOpen', 'write_uid'),
			'hrTimesheetCurrentOpens1' => array(self::HAS_MANY, 'HrTimesheetCurrentOpen', 'create_uid'),
			'irActions' => array(self::HAS_MANY, 'IrActions', 'write_uid'),
			'irActions1' => array(self::HAS_MANY, 'IrActions', 'create_uid'),
			'irActWindowViews' => array(self::HAS_MANY, 'IrActWindowView', 'write_uid'),
			'irActWindowViews1' => array(self::HAS_MANY, 'IrActWindowView', 'create_uid'),
			'irActionsConfigurationWizards' => array(self::HAS_MANY, 'IrActionsConfigurationWizard', 'write_uid'),
			'irActionsConfigurationWizards1' => array(self::HAS_MANY, 'IrActionsConfigurationWizard', 'create_uid'),
			'hrTimesheetInvoiceCreates' => array(self::HAS_MANY, 'HrTimesheetInvoiceCreate', 'write_uid'),
			'hrTimesheetInvoiceCreates1' => array(self::HAS_MANY, 'HrTimesheetInvoiceCreate', 'create_uid'),
			'hrTimesheetInvoiceCreateFinals' => array(self::HAS_MANY, 'HrTimesheetInvoiceCreateFinal', 'write_uid'),
			'hrTimesheetInvoiceCreateFinals1' => array(self::HAS_MANY, 'HrTimesheetInvoiceCreateFinal', 'create_uid'),
			'hrTimesheetSheetSheets' => array(self::HAS_MANY, 'HrTimesheetSheetSheet', 'write_uid'),
			'hrTimesheetSheetSheets1' => array(self::HAS_MANY, 'HrTimesheetSheetSheet', 'create_uid'),
			'irConfigParameters' => array(self::HAS_MANY, 'IrConfigParameter', 'write_uid'),
			'irConfigParameters1' => array(self::HAS_MANY, 'IrConfigParameter', 'create_uid'),
			'irExports' => array(self::HAS_MANY, 'IrExports', 'write_uid'),
			'irExports1' => array(self::HAS_MANY, 'IrExports', 'create_uid'),
			'irMailServers' => array(self::HAS_MANY, 'IrMailServer', 'write_uid'),
			'irMailServers1' => array(self::HAS_MANY, 'IrMailServer', 'create_uid'),
			'irAttachments' => array(self::HAS_MANY, 'IrAttachment', 'write_uid'),
			'irAttachments1' => array(self::HAS_MANY, 'IrAttachment', 'create_uid'),
			'irCrons' => array(self::HAS_MANY, 'IrCron', 'write_uid'),
			'irCrons1' => array(self::HAS_MANY, 'IrCron', 'user_id'),
			'irCrons2' => array(self::HAS_MANY, 'IrCron', 'create_uid'),
			'irModels' => array(self::HAS_MANY, 'IrModel', 'write_uid'),
			'irModels1' => array(self::HAS_MANY, 'IrModel', 'create_uid'),
			'irDefaults' => array(self::HAS_MANY, 'IrDefault', 'write_uid'),
			'irDefaults1' => array(self::HAS_MANY, 'IrDefault', 'uid'),
			'irDefaults2' => array(self::HAS_MANY, 'IrDefault', 'create_uid'),
			'irFieldsConverters' => array(self::HAS_MANY, 'IrFieldsConverter', 'write_uid'),
			'irFieldsConverters1' => array(self::HAS_MANY, 'IrFieldsConverter', 'create_uid'),
			'irModelFields' => array(self::HAS_MANY, 'IrModelFields', 'write_uid'),
			'irModelFields1' => array(self::HAS_MANY, 'IrModelFields', 'create_uid'),
			'irActionsTodos' => array(self::HAS_MANY, 'IrActionsTodo', 'write_uid'),
			'irActionsTodos1' => array(self::HAS_MANY, 'IrActionsTodo', 'create_uid'),
			'irProperties' => array(self::HAS_MANY, 'IrProperty', 'write_uid'),
			'irProperties1' => array(self::HAS_MANY, 'IrProperty', 'create_uid'),
			'irRules' => array(self::HAS_MANY, 'IrRule', 'write_uid'),
			'irRules1' => array(self::HAS_MANY, 'IrRule', 'create_uid'),
			'irModuleModuleDependencies' => array(self::HAS_MANY, 'IrModuleModuleDependency', 'write_uid'),
			'irModuleModuleDependencies1' => array(self::HAS_MANY, 'IrModuleModuleDependency', 'create_uid'),
			'irUiViewScs' => array(self::HAS_MANY, 'IrUiViewSc', 'write_uid'),
			'irUiViewScs1' => array(self::HAS_MANY, 'IrUiViewSc', 'user_id'),
			'irUiViewScs2' => array(self::HAS_MANY, 'IrUiViewSc', 'create_uid'),
			'irServerObjectLines' => array(self::HAS_MANY, 'IrServerObjectLines', 'write_uid'),
			'irServerObjectLines1' => array(self::HAS_MANY, 'IrServerObjectLines', 'create_uid'),
			'irUiViews' => array(self::HAS_MANY, 'IrUiView', 'write_uid'),
			'irUiViews1' => array(self::HAS_MANY, 'IrUiView', 'create_uid'),
			'irValues' => array(self::HAS_MANY, 'IrValues', 'write_uid'),
			'irValues1' => array(self::HAS_MANY, 'IrValues', 'user_id'),
			'irValues2' => array(self::HAS_MANY, 'IrValues', 'create_uid'),
			'mailComposeMessages' => array(self::HAS_MANY, 'MailComposeMessage', 'write_uid'),
			'mailComposeMessages1' => array(self::HAS_MANY, 'MailComposeMessage', 'create_uid'),
			'irSequenceTypes' => array(self::HAS_MANY, 'IrSequenceType', 'write_uid'),
			'irSequenceTypes1' => array(self::HAS_MANY, 'IrSequenceType', 'create_uid'),
			'mailAliases' => array(self::HAS_MANY, 'MailAlias', 'write_uid'),
			'mailAliases1' => array(self::HAS_MANY, 'MailAlias', 'create_uid'),
			'mailAliases2' => array(self::HAS_MANY, 'MailAlias', 'alias_user_id'),
			'mailMessageSubtypes' => array(self::HAS_MANY, 'MailMessageSubtype', 'write_uid'),
			'mailMessageSubtypes1' => array(self::HAS_MANY, 'MailMessageSubtype', 'create_uid'),
			'makeProcurements' => array(self::HAS_MANY, 'MakeProcurement', 'write_uid'),
			'makeProcurements1' => array(self::HAS_MANY, 'MakeProcurement', 'create_uid'),
			'mrpBoms' => array(self::HAS_MANY, 'MrpBom', 'write_uid'),
			'mrpBoms1' => array(self::HAS_MANY, 'MrpBom', 'create_uid'),
			'mrpProductProduces' => array(self::HAS_MANY, 'MrpProductProduce', 'write_uid'),
			'mrpProductProduces1' => array(self::HAS_MANY, 'MrpProductProduce', 'create_uid'),
			'mailVotes' => array(self::HAS_MANY, 'MailVote', 'user_id'),
			'mailWizardInvites' => array(self::HAS_MANY, 'MailWizardInvite', 'write_uid'),
			'mailWizardInvites1' => array(self::HAS_MANY, 'MailWizardInvite', 'create_uid'),
			'mrpConfigSettings' => array(self::HAS_MANY, 'MrpConfigSettings', 'write_uid'),
			'mrpConfigSettings1' => array(self::HAS_MANY, 'MrpConfigSettings', 'create_uid'),
			'mrpProductPrices' => array(self::HAS_MANY, 'MrpProductPrice', 'write_uid'),
			'mrpProductPrices1' => array(self::HAS_MANY, 'MrpProductPrice', 'create_uid'),
			'mrpPropertyGroups' => array(self::HAS_MANY, 'MrpPropertyGroup', 'write_uid'),
			'mrpPropertyGroups1' => array(self::HAS_MANY, 'MrpPropertyGroup', 'create_uid'),
			'mrpWorkcenters' => array(self::HAS_MANY, 'MrpWorkcenter', 'write_uid'),
			'mrpWorkcenters1' => array(self::HAS_MANY, 'MrpWorkcenter', 'create_uid'),
			'mrpRoutingWorkcenters' => array(self::HAS_MANY, 'MrpRoutingWorkcenter', 'write_uid'),
			'mrpRoutingWorkcenters1' => array(self::HAS_MANY, 'MrpRoutingWorkcenter', 'create_uid'),
			'mrpRoutings' => array(self::HAS_MANY, 'MrpRouting', 'write_uid'),
			'mrpRoutings1' => array(self::HAS_MANY, 'MrpRouting', 'create_uid'),
			'pricelistPartnerinfos' => array(self::HAS_MANY, 'PricelistPartnerinfo', 'write_uid'),
			'pricelistPartnerinfos1' => array(self::HAS_MANY, 'PricelistPartnerinfo', 'create_uid'),
			'mrpProductionWorkcenterLines' => array(self::HAS_MANY, 'MrpProductionWorkcenterLine', 'write_uid'),
			'mrpProductionWorkcenterLines1' => array(self::HAS_MANY, 'MrpProductionWorkcenterLine', 'create_uid'),
			'mrpWorkcenterLoads' => array(self::HAS_MANY, 'MrpWorkcenterLoad', 'write_uid'),
			'mrpWorkcenterLoads1' => array(self::HAS_MANY, 'MrpWorkcenterLoad', 'create_uid'),
			'multiCompanyDefaults' => array(self::HAS_MANY, 'MultiCompanyDefault', 'write_uid'),
			'multiCompanyDefaults1' => array(self::HAS_MANY, 'MultiCompanyDefault', 'create_uid'),
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'write_uid'),
			'mrpProductions1' => array(self::HAS_MANY, 'MrpProduction', 'user_id'),
			'mrpProductions2' => array(self::HAS_MANY, 'MrpProduction', 'create_uid'),
			'osvMemoryAutovacuums' => array(self::HAS_MANY, 'OsvMemoryAutovacuum', 'write_uid'),
			'osvMemoryAutovacuums1' => array(self::HAS_MANY, 'OsvMemoryAutovacuum', 'create_uid'),
			'processConditions' => array(self::HAS_MANY, 'ProcessCondition', 'write_uid'),
			'processConditions1' => array(self::HAS_MANY, 'ProcessCondition', 'create_uid'),
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'write_uid'),
			'procurementOrders1' => array(self::HAS_MANY, 'ProcurementOrder', 'create_uid'),
			'productPricelistItems' => array(self::HAS_MANY, 'ProductPricelistItem', 'write_uid'),
			'productPricelistItems1' => array(self::HAS_MANY, 'ProductPricelistItem', 'create_uid'),
			'productPackagings' => array(self::HAS_MANY, 'ProductPackaging', 'write_uid'),
			'productPackagings1' => array(self::HAS_MANY, 'ProductPackaging', 'create_uid'),
			'processTransitions' => array(self::HAS_MANY, 'ProcessTransition', 'write_uid'),
			'processTransitions1' => array(self::HAS_MANY, 'ProcessTransition', 'create_uid'),
			'processProcesses' => array(self::HAS_MANY, 'ProcessProcess', 'write_uid'),
			'processProcesses1' => array(self::HAS_MANY, 'ProcessProcess', 'create_uid'),
			'procurementOrderComputeAlls' => array(self::HAS_MANY, 'ProcurementOrderComputeAll', 'write_uid'),
			'procurementOrderComputeAlls1' => array(self::HAS_MANY, 'ProcurementOrderComputeAll', 'create_uid'),
			'procurementOrderComputes' => array(self::HAS_MANY, 'ProcurementOrderCompute', 'write_uid'),
			'procurementOrderComputes1' => array(self::HAS_MANY, 'ProcurementOrderCompute', 'create_uid'),
			'procurementOrderpointComputes' => array(self::HAS_MANY, 'ProcurementOrderpointCompute', 'write_uid'),
			'procurementOrderpointComputes1' => array(self::HAS_MANY, 'ProcurementOrderpointCompute', 'create_uid'),
			'productPriceLists' => array(self::HAS_MANY, 'ProductPriceList', 'write_uid'),
			'productPriceLists1' => array(self::HAS_MANY, 'ProductPriceList', 'create_uid'),
			'productPriceTypes' => array(self::HAS_MANY, 'ProductPriceType', 'write_uid'),
			'productPriceTypes1' => array(self::HAS_MANY, 'ProductPriceType', 'create_uid'),
			'productCategories' => array(self::HAS_MANY, 'ProductCategory', 'write_uid'),
			'productCategories1' => array(self::HAS_MANY, 'ProductCategory', 'create_uid'),
			'productPricelistTypes' => array(self::HAS_MANY, 'ProductPricelistType', 'write_uid'),
			'productPricelistTypes1' => array(self::HAS_MANY, 'ProductPricelistType', 'create_uid'),
			'productUomCategs' => array(self::HAS_MANY, 'ProductUomCateg', 'write_uid'),
			'productUomCategs1' => array(self::HAS_MANY, 'ProductUomCateg', 'create_uid'),
			'projectTasks' => array(self::HAS_MANY, 'ProjectTask', 'write_uid'),
			'projectTasks1' => array(self::HAS_MANY, 'ProjectTask', 'user_id'),
			'projectTasks2' => array(self::HAS_MANY, 'ProjectTask', 'create_uid'),
			'projectCategories' => array(self::HAS_MANY, 'ProjectCategory', 'write_uid'),
			'projectCategories1' => array(self::HAS_MANY, 'ProjectCategory', 'create_uid'),
			'projectProjects' => array(self::HAS_MANY, 'ProjectProject', 'write_uid'),
			'projectProjects1' => array(self::HAS_MANY, 'ProjectProject', 'create_uid'),
			'projectTaskReevaluates' => array(self::HAS_MANY, 'ProjectTaskReevaluate', 'write_uid'),
			'projectTaskReevaluates1' => array(self::HAS_MANY, 'ProjectTaskReevaluate', 'create_uid'),
			'productUls' => array(self::HAS_MANY, 'ProductUl', 'write_uid'),
			'productUls1' => array(self::HAS_MANY, 'ProductUl', 'create_uid'),
			'productPricelistVersions' => array(self::HAS_MANY, 'ProductPricelistVersion', 'write_uid'),
			'productPricelistVersions1' => array(self::HAS_MANY, 'ProductPricelistVersion', 'create_uid'),
			'projectTaskHistories' => array(self::HAS_MANY, 'ProjectTaskHistory', 'user_id'),
			'projectAccountAnalyticLines' => array(self::HAS_MANY, 'ProjectAccountAnalyticLine', 'write_uid'),
			'projectAccountAnalyticLines1' => array(self::HAS_MANY, 'ProjectAccountAnalyticLine', 'create_uid'),
			'projectConfigSettings' => array(self::HAS_MANY, 'ProjectConfigSettings', 'write_uid'),
			'projectConfigSettings1' => array(self::HAS_MANY, 'ProjectConfigSettings', 'create_uid'),
			'purchaseConfigSettings' => array(self::HAS_MANY, 'PurchaseConfigSettings', 'write_uid'),
			'purchaseConfigSettings1' => array(self::HAS_MANY, 'PurchaseConfigSettings', 'create_uid'),
			'purchaseOrderLineInvoices' => array(self::HAS_MANY, 'PurchaseOrderLineInvoice', 'write_uid'),
			'purchaseOrderLineInvoices1' => array(self::HAS_MANY, 'PurchaseOrderLineInvoice', 'create_uid'),
			'projectTaskTypes' => array(self::HAS_MANY, 'ProjectTaskType', 'write_uid'),
			'projectTaskTypes1' => array(self::HAS_MANY, 'ProjectTaskType', 'create_uid'),
			'projectTaskWorks' => array(self::HAS_MANY, 'ProjectTaskWork', 'write_uid'),
			'projectTaskWorks1' => array(self::HAS_MANY, 'ProjectTaskWork', 'user_id'),
			'projectTaskWorks2' => array(self::HAS_MANY, 'ProjectTaskWork', 'create_uid'),
			'purchaseOrderLines' => array(self::HAS_MANY, 'PurchaseOrderLine', 'write_uid'),
			'purchaseOrderLines1' => array(self::HAS_MANY, 'PurchaseOrderLine', 'create_uid'),
			'projectUserRels' => array(self::HAS_MANY, 'ProjectUserRel', 'uid'),
			'publisherWarrantyContracts' => array(self::HAS_MANY, 'PublisherWarrantyContract', 'write_uid'),
			'publisherWarrantyContracts1' => array(self::HAS_MANY, 'PublisherWarrantyContract', 'create_uid'),
			'purchaseOrderGroups' => array(self::HAS_MANY, 'PurchaseOrderGroup', 'write_uid'),
			'purchaseOrderGroups1' => array(self::HAS_MANY, 'PurchaseOrderGroup', 'create_uid'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'write_uid'),
			'purchaseOrders1' => array(self::HAS_MANY, 'PurchaseOrder', 'validator'),
			'purchaseOrders2' => array(self::HAS_MANY, 'PurchaseOrder', 'create_uid'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'write_uid'),
			'stockMoves1' => array(self::HAS_MANY, 'StockMove', 'create_uid'),
			'tempRanges' => array(self::HAS_MANY, 'TempRange', 'write_uid'),
			'tempRanges1' => array(self::HAS_MANY, 'TempRange', 'create_uid'),
			'stockInventories' => array(self::HAS_MANY, 'StockInventory', 'write_uid'),
			'stockInventories1' => array(self::HAS_MANY, 'StockInventory', 'create_uid'),
			'stockInventoryLines' => array(self::HAS_MANY, 'StockInventoryLine', 'write_uid'),
			'stockInventoryLines1' => array(self::HAS_MANY, 'StockInventoryLine', 'create_uid'),
			'resCountries' => array(self::HAS_MANY, 'ResCountry', 'write_uid'),
			'resCountries1' => array(self::HAS_MANY, 'ResCountry', 'create_uid'),
			'stockPickings' => array(self::HAS_MANY, 'StockPicking', 'write_uid'),
			'stockPickings1' => array(self::HAS_MANY, 'StockPicking', 'create_uid'),
			'resCompanyUsersRels' => array(self::HAS_MANY, 'ResCompanyUsersRel', 'user_id'),
			'resAlarms' => array(self::HAS_MANY, 'ResAlarm', 'write_uid'),
			'resAlarms1' => array(self::HAS_MANY, 'ResAlarm', 'create_uid'),
			'resConfigs' => array(self::HAS_MANY, 'ResConfig', 'write_uid'),
			'resConfigs1' => array(self::HAS_MANY, 'ResConfig', 'create_uid'),
			'resConfigInstallers' => array(self::HAS_MANY, 'ResConfigInstaller', 'write_uid'),
			'resConfigInstallers1' => array(self::HAS_MANY, 'ResConfigInstaller', 'create_uid'),
			'resConfigSettings' => array(self::HAS_MANY, 'ResConfigSettings', 'write_uid'),
			'resConfigSettings1' => array(self::HAS_MANY, 'ResConfigSettings', 'create_uid'),
			'resGroupsUsersRels' => array(self::HAS_MANY, 'ResGroupsUsersRel', 'uid'),
			'resCurrencyRateTypes' => array(self::HAS_MANY, 'ResCurrencyRateType', 'write_uid'),
			'resCurrencyRateTypes1' => array(self::HAS_MANY, 'ResCurrencyRateType', 'create_uid'),
			'resLangs' => array(self::HAS_MANY, 'ResLang', 'write_uid'),
			'resLangs1' => array(self::HAS_MANY, 'ResLang', 'create_uid'),
			'resPartnerBanks' => array(self::HAS_MANY, 'ResPartnerBank', 'write_uid'),
			'resPartnerBanks1' => array(self::HAS_MANY, 'ResPartnerBank', 'create_uid'),
			'resRequestHistories' => array(self::HAS_MANY, 'ResRequestHistory', 'write_uid'),
			'resRequestHistories1' => array(self::HAS_MANY, 'ResRequestHistory', 'create_uid'),
			'resRequestHistories2' => array(self::HAS_MANY, 'ResRequestHistory', 'act_to'),
			'resRequestHistories3' => array(self::HAS_MANY, 'ResRequestHistory', 'act_from'),
			'resRequests' => array(self::HAS_MANY, 'ResRequest', 'write_uid'),
			'resRequests1' => array(self::HAS_MANY, 'ResRequest', 'create_uid'),
			'resRequests2' => array(self::HAS_MANY, 'ResRequest', 'act_to'),
			'resRequests3' => array(self::HAS_MANY, 'ResRequest', 'act_from'),
			'resourceCalendars' => array(self::HAS_MANY, 'ResourceCalendar', 'write_uid'),
			'resourceCalendars1' => array(self::HAS_MANY, 'ResourceCalendar', 'manager'),
			'resourceCalendars2' => array(self::HAS_MANY, 'ResourceCalendar', 'create_uid'),
			'resPartnerBankTypes' => array(self::HAS_MANY, 'ResPartnerBankType', 'write_uid'),
			'resPartnerBankTypes1' => array(self::HAS_MANY, 'ResPartnerBankType', 'create_uid'),
			'resPartnerCategories' => array(self::HAS_MANY, 'ResPartnerCategory', 'write_uid'),
			'resPartnerCategories1' => array(self::HAS_MANY, 'ResPartnerCategory', 'create_uid'),
			'resGroups' => array(self::HAS_MANY, 'ResGroups', 'write_uid'),
			'resGroups1' => array(self::HAS_MANY, 'ResGroups', 'create_uid'),
			'resPartnerBankTypeFields' => array(self::HAS_MANY, 'ResPartnerBankTypeField', 'write_uid'),
			'resPartnerBankTypeFields1' => array(self::HAS_MANY, 'ResPartnerBankTypeField', 'create_uid'),
			'resPartnerTitles' => array(self::HAS_MANY, 'ResPartnerTitle', 'write_uid'),
			'resPartnerTitles1' => array(self::HAS_MANY, 'ResPartnerTitle', 'create_uid'),
			'resRequestLinks' => array(self::HAS_MANY, 'ResRequestLink', 'write_uid'),
			'resRequestLinks1' => array(self::HAS_MANY, 'ResRequestLink', 'create_uid'),
			'saleConfigSettings' => array(self::HAS_MANY, 'SaleConfigSettings', 'write_uid'),
			'saleConfigSettings1' => array(self::HAS_MANY, 'SaleConfigSettings', 'create_uid'),
			'saleOrderLineMakeInvoices' => array(self::HAS_MANY, 'SaleOrderLineMakeInvoice', 'write_uid'),
			'saleOrderLineMakeInvoices1' => array(self::HAS_MANY, 'SaleOrderLineMakeInvoice', 'create_uid'),
			'shareWizards' => array(self::HAS_MANY, 'ShareWizard', 'write_uid'),
			'shareWizards1' => array(self::HAS_MANY, 'ShareWizard', 'create_uid'),
			'resourceResources' => array(self::HAS_MANY, 'ResourceResource', 'write_uid'),
			'resourceResources1' => array(self::HAS_MANY, 'ResourceResource', 'user_id'),
			'resourceResources2' => array(self::HAS_MANY, 'ResourceResource', 'create_uid'),
			'resourceCalendarAttendances' => array(self::HAS_MANY, 'ResourceCalendarAttendance', 'write_uid'),
			'resourceCalendarAttendances1' => array(self::HAS_MANY, 'ResourceCalendarAttendance', 'create_uid'),
			'saleAdvancePaymentInvs' => array(self::HAS_MANY, 'SaleAdvancePaymentInv', 'write_uid'),
			'saleAdvancePaymentInvs1' => array(self::HAS_MANY, 'SaleAdvancePaymentInv', 'create_uid'),
			'saleMakeInvoices' => array(self::HAS_MANY, 'SaleMakeInvoice', 'write_uid'),
			'saleMakeInvoices1' => array(self::HAS_MANY, 'SaleMakeInvoice', 'create_uid'),
			'saleMemberRels' => array(self::HAS_MANY, 'SaleMemberRel', 'member_id'),
			'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'write_uid'),
			'saleOrders1' => array(self::HAS_MANY, 'SaleOrder', 'user_id'),
			'saleOrders2' => array(self::HAS_MANY, 'SaleOrder', 'create_uid'),
			'shareWizardResultLines' => array(self::HAS_MANY, 'ShareWizardResultLine', 'write_uid'),
			'shareWizardResultLines1' => array(self::HAS_MANY, 'ShareWizardResultLine', 'user_id'),
			'shareWizardResultLines2' => array(self::HAS_MANY, 'ShareWizardResultLine', 'create_uid'),
			'saleOrderLines' => array(self::HAS_MANY, 'SaleOrderLine', 'write_uid'),
			'saleOrderLines1' => array(self::HAS_MANY, 'SaleOrderLine', 'create_uid'),
			'stockMoveConsumes' => array(self::HAS_MANY, 'StockMoveConsume', 'write_uid'),
			'stockMoveConsumes1' => array(self::HAS_MANY, 'StockMoveConsume', 'create_uid'),
			'stockInventoryLineSplits' => array(self::HAS_MANY, 'StockInventoryLineSplit', 'write_uid'),
			'stockInventoryLineSplits1' => array(self::HAS_MANY, 'StockInventoryLineSplit', 'create_uid'),
			'stockInvoiceOnshippings' => array(self::HAS_MANY, 'StockInvoiceOnshipping', 'write_uid'),
			'stockInvoiceOnshippings1' => array(self::HAS_MANY, 'StockInvoiceOnshipping', 'create_uid'),
			'stockLocationProducts' => array(self::HAS_MANY, 'StockLocationProduct', 'write_uid'),
			'stockLocationProducts1' => array(self::HAS_MANY, 'StockLocationProduct', 'create_uid'),
			'stockMoveScraps' => array(self::HAS_MANY, 'StockMoveScrap', 'write_uid'),
			'stockMoveScraps1' => array(self::HAS_MANY, 'StockMoveScrap', 'create_uid'),
			'stockJournals' => array(self::HAS_MANY, 'StockJournal', 'write_uid'),
			'stockJournals1' => array(self::HAS_MANY, 'StockJournal', 'user_id'),
			'stockJournals2' => array(self::HAS_MANY, 'StockJournal', 'create_uid'),
			'stockFillInventories' => array(self::HAS_MANY, 'StockFillInventory', 'write_uid'),
			'stockFillInventories1' => array(self::HAS_MANY, 'StockFillInventory', 'create_uid'),
			'stockChangeProductQties' => array(self::HAS_MANY, 'StockChangeProductQty', 'write_uid'),
			'stockChangeProductQties1' => array(self::HAS_MANY, 'StockChangeProductQty', 'create_uid'),
			'stockChangeStandardPrices' => array(self::HAS_MANY, 'StockChangeStandardPrice', 'write_uid'),
			'stockChangeStandardPrices1' => array(self::HAS_MANY, 'StockChangeStandardPrice', 'create_uid'),
			'stockConfigSettings' => array(self::HAS_MANY, 'StockConfigSettings', 'write_uid'),
			'stockConfigSettings1' => array(self::HAS_MANY, 'StockConfigSettings', 'create_uid'),
			'stockInventoryMerges' => array(self::HAS_MANY, 'StockInventoryMerge', 'write_uid'),
			'stockInventoryMerges1' => array(self::HAS_MANY, 'StockInventoryMerge', 'create_uid'),
			'stockPartialPickingLines' => array(self::HAS_MANY, 'StockPartialPickingLine', 'write_uid'),
			'stockPartialPickingLines1' => array(self::HAS_MANY, 'StockPartialPickingLine', 'create_uid'),
			'stockReturnPickingMemories' => array(self::HAS_MANY, 'StockReturnPickingMemory', 'write_uid'),
			'stockReturnPickingMemories1' => array(self::HAS_MANY, 'StockReturnPickingMemory', 'create_uid'),
			'stockProductionLotRevisions' => array(self::HAS_MANY, 'StockProductionLotRevision', 'write_uid'),
			'stockProductionLotRevisions1' => array(self::HAS_MANY, 'StockProductionLotRevision', 'create_uid'),
			'stockProductionLotRevisions2' => array(self::HAS_MANY, 'StockProductionLotRevision', 'author_id'),
			'stockReturnPickings' => array(self::HAS_MANY, 'StockReturnPicking', 'write_uid'),
			'stockReturnPickings1' => array(self::HAS_MANY, 'StockReturnPicking', 'create_uid'),
			'stockSplitIntos' => array(self::HAS_MANY, 'StockSplitInto', 'write_uid'),
			'stockSplitIntos1' => array(self::HAS_MANY, 'StockSplitInto', 'create_uid'),
			'stockWarehouseOrderpoints' => array(self::HAS_MANY, 'StockWarehouseOrderpoint', 'write_uid'),
			'stockWarehouseOrderpoints1' => array(self::HAS_MANY, 'StockWarehouseOrderpoint', 'create_uid'),
			'stockMoveSplits' => array(self::HAS_MANY, 'StockMoveSplit', 'write_uid'),
			'stockMoveSplits1' => array(self::HAS_MANY, 'StockMoveSplit', 'create_uid'),
			'stockTrackings' => array(self::HAS_MANY, 'StockTracking', 'write_uid'),
			'stockTrackings1' => array(self::HAS_MANY, 'StockTracking', 'create_uid'),
			'stockPartialMoves' => array(self::HAS_MANY, 'StockPartialMove', 'write_uid'),
			'stockPartialMoves1' => array(self::HAS_MANY, 'StockPartialMove', 'create_uid'),
			'stockPartialPickings' => array(self::HAS_MANY, 'StockPartialPicking', 'write_uid'),
			'stockPartialPickings1' => array(self::HAS_MANY, 'StockPartialPicking', 'create_uid'),
			'wizardIrModelMenuCreates' => array(self::HAS_MANY, 'WizardIrModelMenuCreate', 'write_uid'),
			'wizardIrModelMenuCreates1' => array(self::HAS_MANY, 'WizardIrModelMenuCreate', 'create_uid'),
			'validateAccountMoves' => array(self::HAS_MANY, 'ValidateAccountMove', 'write_uid'),
			'validateAccountMoves1' => array(self::HAS_MANY, 'ValidateAccountMove', 'create_uid'),
			'validateAccountMoveLines' => array(self::HAS_MANY, 'ValidateAccountMoveLines', 'write_uid'),
			'validateAccountMoveLines1' => array(self::HAS_MANY, 'ValidateAccountMoveLines', 'create_uid'),
			'wkfLogs' => array(self::HAS_MANY, 'WkfLogs', 'uid'),
			'wkfs' => array(self::HAS_MANY, 'Wkf', 'write_uid'),
			'wkfs1' => array(self::HAS_MANY, 'Wkf', 'create_uid'),
			'accountInvoiceLines' => array(self::HAS_MANY, 'AccountInvoiceLine', 'write_uid'),
			'accountInvoiceLines1' => array(self::HAS_MANY, 'AccountInvoiceLine', 'create_uid'),
			'accountPaymentTerms' => array(self::HAS_MANY, 'AccountPaymentTerm', 'write_uid'),
			'accountPaymentTerms1' => array(self::HAS_MANY, 'AccountPaymentTerm', 'create_uid'),
			'accountTaxes' => array(self::HAS_MANY, 'AccountTax', 'write_uid'),
			'accountTaxes1' => array(self::HAS_MANY, 'AccountTax', 'create_uid'),
			'accountAnalyticAccounts' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'write_uid'),
			'accountAnalyticAccounts1' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'user_id'),
			'accountAnalyticAccounts2' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'manager_id'),
			'accountAnalyticAccounts3' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'create_uid'),
			'accountJournals' => array(self::HAS_MANY, 'AccountJournal', 'write_uid'),
			'accountJournals1' => array(self::HAS_MANY, 'AccountJournal', 'user_id'),
			'accountJournals2' => array(self::HAS_MANY, 'AccountJournal', 'create_uid'),
			'crmCaseSections' => array(self::HAS_MANY, 'CrmCaseSection', 'write_uid'),
			'crmCaseSections1' => array(self::HAS_MANY, 'CrmCaseSection', 'user_id'),
			'crmCaseSections2' => array(self::HAS_MANY, 'CrmCaseSection', 'create_uid'),
			'accountFiscalPositionAccountTemplates' => array(self::HAS_MANY, 'AccountFiscalPositionAccountTemplate', 'write_uid'),
			'accountFiscalPositionAccountTemplates1' => array(self::HAS_MANY, 'AccountFiscalPositionAccountTemplate', 'create_uid'),
			'resCompanies' => array(self::HAS_MANY, 'ResCompany', 'write_uid'),
			'resCompanies1' => array(self::HAS_MANY, 'ResCompany', 'create_uid'),
			'irFilters' => array(self::HAS_MANY, 'IrFilters', 'write_uid'),
			'irFilters1' => array(self::HAS_MANY, 'IrFilters', 'user_id'),
			'irFilters2' => array(self::HAS_MANY, 'IrFilters', 'create_uid'),
			'accountFiscalPositionAccounts' => array(self::HAS_MANY, 'AccountFiscalPositionAccount', 'write_uid'),
			'accountFiscalPositionAccounts1' => array(self::HAS_MANY, 'AccountFiscalPositionAccount', 'create_uid'),
			'accountAccountTemplates' => array(self::HAS_MANY, 'AccountAccountTemplate', 'write_uid'),
			'accountAccountTemplates1' => array(self::HAS_MANY, 'AccountAccountTemplate', 'create_uid'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'write_uid'),
			'accountVouchers1' => array(self::HAS_MANY, 'AccountVoucher', 'create_uid'),
			'accountAccounts' => array(self::HAS_MANY, 'AccountAccount', 'write_uid'),
			'accountAccounts1' => array(self::HAS_MANY, 'AccountAccount', 'create_uid'),
			'irUiMenus' => array(self::HAS_MANY, 'IrUiMenu', 'write_uid'),
			'irUiMenus1' => array(self::HAS_MANY, 'IrUiMenu', 'create_uid'),
			'accountFiscalyears' => array(self::HAS_MANY, 'AccountFiscalyear', 'write_uid'),
			'accountFiscalyears1' => array(self::HAS_MANY, 'AccountFiscalyear', 'create_uid'),
			'calendarAlarms' => array(self::HAS_MANY, 'CalendarAlarm', 'write_uid'),
			'calendarAlarms1' => array(self::HAS_MANY, 'CalendarAlarm', 'user_id'),
			'calendarAlarms2' => array(self::HAS_MANY, 'CalendarAlarm', 'create_uid'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'resUsers' => array(self::HAS_MANY, 'ResUsers', 'write_uid'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'defaultSection' => array(self::BELONGS_TO, 'CrmCaseSection', 'default_section_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'resUsers1' => array(self::HAS_MANY, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'alias' => array(self::BELONGS_TO, 'MailAlias', 'alias_id'),
			'baseImportTestsModelsCharNoreadonlies' => array(self::HAS_MANY, 'BaseImportTestsModelsCharNoreadonly', 'write_uid'),
			'baseImportTestsModelsCharNoreadonlies1' => array(self::HAS_MANY, 'BaseImportTestsModelsCharNoreadonly', 'create_uid'),
			'accountFinancialReports' => array(self::HAS_MANY, 'AccountFinancialReport', 'write_uid'),
			'accountFinancialReports1' => array(self::HAS_MANY, 'AccountFinancialReport', 'create_uid'),
			'resPartners' => array(self::HAS_MANY, 'ResPartner', 'write_uid'),
			'resPartners1' => array(self::HAS_MANY, 'ResPartner', 'user_id'),
			'resPartners2' => array(self::HAS_MANY, 'ResPartner', 'create_uid'),
			'productPricelists' => array(self::HAS_MANY, 'ProductPricelist', 'write_uid'),
			'productPricelists1' => array(self::HAS_MANY, 'ProductPricelist', 'create_uid'),
			'accountTaxTemplates' => array(self::HAS_MANY, 'AccountTaxTemplate', 'write_uid'),
			'accountTaxTemplates1' => array(self::HAS_MANY, 'AccountTaxTemplate', 'create_uid'),
			'resCurrencies' => array(self::HAS_MANY, 'ResCurrency', 'write_uid'),
			'resCurrencies1' => array(self::HAS_MANY, 'ResCurrency', 'create_uid'),
			'productProducts' => array(self::HAS_MANY, 'ProductProduct', 'write_uid'),
			'productProducts1' => array(self::HAS_MANY, 'ProductProduct', 'create_uid'),
			'irSequences' => array(self::HAS_MANY, 'IrSequence', 'write_uid'),
			'irSequences1' => array(self::HAS_MANY, 'IrSequence', 'create_uid'),
			'baseImportTestsModelsM2os' => array(self::HAS_MANY, 'BaseImportTestsModelsM2o', 'write_uid'),
			'baseImportTestsModelsM2os1' => array(self::HAS_MANY, 'BaseImportTestsModelsM2o', 'create_uid'),
			'baseImportTestsModelsM2oRequireds' => array(self::HAS_MANY, 'BaseImportTestsModelsM2oRequired', 'write_uid'),
			'baseImportTestsModelsM2oRequireds1' => array(self::HAS_MANY, 'BaseImportTestsModelsM2oRequired', 'create_uid'),
			'hrTimesheetInvoiceFactors' => array(self::HAS_MANY, 'HrTimesheetInvoiceFactor', 'write_uid'),
			'hrTimesheetInvoiceFactors1' => array(self::HAS_MANY, 'HrTimesheetInvoiceFactor', 'create_uid'),
			'hrTimesheetAnalyticProfits' => array(self::HAS_MANY, 'HrTimesheetAnalyticProfit', 'write_uid'),
			'hrTimesheetAnalyticProfits1' => array(self::HAS_MANY, 'HrTimesheetAnalyticProfit', 'create_uid'),
			'wizardMultiChartsAccounts' => array(self::HAS_MANY, 'WizardMultiChartsAccounts', 'write_uid'),
			'wizardMultiChartsAccounts1' => array(self::HAS_MANY, 'WizardMultiChartsAccounts', 'create_uid'),
			'cashBoxOuts' => array(self::HAS_MANY, 'CashBoxOut', 'write_uid'),
			'cashBoxOuts1' => array(self::HAS_MANY, 'CashBoxOut', 'create_uid'),
			'processNodes' => array(self::HAS_MANY, 'ProcessNode', 'write_uid'),
			'processNodes1' => array(self::HAS_MANY, 'ProcessNode', 'create_uid'),
			'changePasswordUsers' => array(self::HAS_MANY, 'ChangePasswordUser', 'write_uid'),
			'changePasswordUsers1' => array(self::HAS_MANY, 'ChangePasswordUser', 'user_id'),
			'changePasswordUsers2' => array(self::HAS_MANY, 'ChangePasswordUser', 'create_uid'),
			'crmLead2opportunityPartnerMassResUsersRels' => array(self::HAS_MANY, 'CrmLead2opportunityPartnerMassResUsersRel', 'res_users_id'),
			'mailMails' => array(self::HAS_MANY, 'MailMail', 'write_uid'),
			'mailMails1' => array(self::HAS_MANY, 'MailMail', 'create_uid'),
			'crmPaymentModes' => array(self::HAS_MANY, 'CrmPaymentMode', 'write_uid'),
			'crmPaymentModes1' => array(self::HAS_MANY, 'CrmPaymentMode', 'create_uid'),
			'mrpProductionProductLines' => array(self::HAS_MANY, 'MrpProductionProductLine', 'write_uid'),
			'mrpProductionProductLines1' => array(self::HAS_MANY, 'MrpProductionProductLine', 'create_uid'),
			'crmSegmentationLines' => array(self::HAS_MANY, 'CrmSegmentationLine', 'write_uid'),
			'crmSegmentationLines1' => array(self::HAS_MANY, 'CrmSegmentationLine', 'create_uid'),
			'hrAnalyticalTimesheetEmployees' => array(self::HAS_MANY, 'HrAnalyticalTimesheetEmployee', 'write_uid'),
			'hrAnalyticalTimesheetEmployees1' => array(self::HAS_MANY, 'HrAnalyticalTimesheetEmployee', 'create_uid'),
			'irExportsLines' => array(self::HAS_MANY, 'IrExportsLine', 'write_uid'),
			'irExportsLines1' => array(self::HAS_MANY, 'IrExportsLine', 'create_uid'),
			'productSupplierinfos' => array(self::HAS_MANY, 'ProductSupplierinfo', 'write_uid'),
			'productSupplierinfos1' => array(self::HAS_MANY, 'ProductSupplierinfo', 'create_uid'),
			'hrAttendances' => array(self::HAS_MANY, 'HrAttendance', 'write_uid'),
			'hrAttendances1' => array(self::HAS_MANY, 'HrAttendance', 'create_uid'),
			'irModelAccesses' => array(self::HAS_MANY, 'IrModelAccess', 'write_uid'),
			'irModelAccesses1' => array(self::HAS_MANY, 'IrModelAccess', 'create_uid'),
			'irUiViewCustoms' => array(self::HAS_MANY, 'IrUiViewCustom', 'write_uid'),
			'irUiViewCustoms1' => array(self::HAS_MANY, 'IrUiViewCustom', 'user_id'),
			'irUiViewCustoms2' => array(self::HAS_MANY, 'IrUiViewCustom', 'create_uid'),
			'hrEmployeeCategories' => array(self::HAS_MANY, 'HrEmployeeCategory', 'write_uid'),
			'hrEmployeeCategories1' => array(self::HAS_MANY, 'HrEmployeeCategory', 'create_uid'),
			'mailMessages' => array(self::HAS_MANY, 'MailMessage', 'write_uid'),
			'mailMessages1' => array(self::HAS_MANY, 'MailMessage', 'create_uid'),
			'mailGroups' => array(self::HAS_MANY, 'MailGroup', 'write_uid'),
			'mailGroups1' => array(self::HAS_MANY, 'MailGroup', 'create_uid'),
			'processTransitionActions' => array(self::HAS_MANY, 'ProcessTransitionAction', 'write_uid'),
			'processTransitionActions1' => array(self::HAS_MANY, 'ProcessTransitionAction', 'create_uid'),
			'stockInventoryLineSplitLines' => array(self::HAS_MANY, 'StockInventoryLineSplitLines', 'write_uid'),
			'stockInventoryLineSplitLines1' => array(self::HAS_MANY, 'StockInventoryLineSplitLines', 'create_uid'),
			'resBanks' => array(self::HAS_MANY, 'ResBank', 'write_uid'),
			'resBanks1' => array(self::HAS_MANY, 'ResBank', 'create_uid'),
			'saleShops' => array(self::HAS_MANY, 'SaleShop', 'write_uid'),
			'saleShops1' => array(self::HAS_MANY, 'SaleShop', 'create_uid'),
			'irModuleCategories' => array(self::HAS_MANY, 'IrModuleCategory', 'write_uid'),
			'irModuleCategories1' => array(self::HAS_MANY, 'IrModuleCategory', 'create_uid'),
			'irModuleModules' => array(self::HAS_MANY, 'IrModuleModule', 'write_uid'),
			'irModuleModules1' => array(self::HAS_MANY, 'IrModuleModule', 'create_uid'),
			'projectTaskDelegates' => array(self::HAS_MANY, 'ProjectTaskDelegate', 'write_uid'),
			'projectTaskDelegates1' => array(self::HAS_MANY, 'ProjectTaskDelegate', 'user_id'),
			'projectTaskDelegates2' => array(self::HAS_MANY, 'ProjectTaskDelegate', 'create_uid'),
			'resourceCalendarLeaves' => array(self::HAS_MANY, 'ResourceCalendarLeaves', 'write_uid'),
			'resourceCalendarLeaves1' => array(self::HAS_MANY, 'ResourceCalendarLeaves', 'create_uid'),
			'resCountryStates' => array(self::HAS_MANY, 'ResCountryState', 'write_uid'),
			'resCountryStates1' => array(self::HAS_MANY, 'ResCountryState', 'create_uid'),
			'stockLocations' => array(self::HAS_MANY, 'StockLocation', 'write_uid'),
			'stockLocations1' => array(self::HAS_MANY, 'StockLocation', 'create_uid'),
			'mrpProperties' => array(self::HAS_MANY, 'MrpProperty', 'write_uid'),
			'mrpProperties1' => array(self::HAS_MANY, 'MrpProperty', 'create_uid'),
			'stockPartialMoveLines' => array(self::HAS_MANY, 'StockPartialMoveLine', 'write_uid'),
			'stockPartialMoveLines1' => array(self::HAS_MANY, 'StockPartialMoveLine', 'create_uid'),
			'stockIncoterms' => array(self::HAS_MANY, 'StockIncoterms', 'write_uid'),
			'stockIncoterms1' => array(self::HAS_MANY, 'StockIncoterms', 'create_uid'),
			'stockProductionLots' => array(self::HAS_MANY, 'StockProductionLot', 'write_uid'),
			'stockProductionLots1' => array(self::HAS_MANY, 'StockProductionLot', 'create_uid'),
			'stockMoveSplitLines' => array(self::HAS_MANY, 'StockMoveSplitLines', 'write_uid'),
			'stockMoveSplitLines1' => array(self::HAS_MANY, 'StockMoveSplitLines', 'create_uid'),
			'wkfTransitions' => array(self::HAS_MANY, 'WkfTransition', 'write_uid'),
			'wkfTransitions1' => array(self::HAS_MANY, 'WkfTransition', 'create_uid'),
			'stockWarehouses' => array(self::HAS_MANY, 'StockWarehouse', 'write_uid'),
			'stockWarehouses1' => array(self::HAS_MANY, 'StockWarehouse', 'create_uid'),
			'wkfActivities' => array(self::HAS_MANY, 'WkfActivity', 'write_uid'),
			'wkfActivities1' => array(self::HAS_MANY, 'WkfActivity', 'create_uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'active' => 'Active',
			'login' => 'Login',
			'password' => 'Password',
			'company_id' => 'Company',
			'partner_id' => 'Partner',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'menu_id' => 'Menu',
			'login_date' => 'Login Date',
			'signature' => 'Signature',
			'action_id' => 'Action',
			'alias_id' => 'Alias',
			'share' => 'Share',
			'default_section_id' => 'Default Section',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('active',$this->active);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('login_date',$this->login_date,true);
		$criteria->compare('signature',$this->signature,true);
		$criteria->compare('action_id',$this->action_id);
		$criteria->compare('alias_id',$this->alias_id);
		$criteria->compare('share',$this->share);
		$criteria->compare('default_section_id',$this->default_section_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbopenerp;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
