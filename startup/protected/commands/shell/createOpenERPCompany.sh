#!/bin/bash
#
SHELL=/bin/sh
PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
MAILTO=root

# Variables
TAG=$1
NAME=$2
PW=$3
BUSINESSID=$4
EMAIL=$5
BANKACCOUNT=$6

DB=$TAG
TEMPLATE="protected/commands/sql/template_default.sql"
INPUTFILE="/tmp/${DB}.sql"

# Create temporary database dump file
cp $TEMPLATE $INPUTFILE

# Replace names etc.
sed -i "s/companyName/${NAME}/g" $INPUTFILE
sed -i "s/companyPassword/${PW}/g" $INPUTFILE
sed -i "s/companyBusinessId/${BUSINESSID}/g" $INPUTFILE
sed -i "s/companyTagline/${NAME}/g" $INPUTFILE
sed -i "s/companyWebsite/http\:\/\/${TAG}.com/g" $INPUTFILE
sed -i "s/companyEmail/${EMAIL}/g" $INPUTFILE
sed -i "s/companyBankAccount/${BANKACCOUNT}/g" $INPUTFILE

psql -h erp.futurality.fi -U openerp -d postgres -c "CREATE DATABASE ${DB}"
psql -h erp.futurality.fi -U openerp -d $DB < $INPUTFILE