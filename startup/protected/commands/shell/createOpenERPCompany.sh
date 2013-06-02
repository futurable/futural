#!/bin/bash
#
SHELL=/bin/sh
PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
MAILTO=root

# Variables
TAG=$1
NAME=$2
PW=$3
EMAIL=$4

DB=$TAG
TEMPLATE="protected/commands/sql/futural_template.sql"
INPUTFILE="/tmp/${DB}.sql"

# Create temporary database dump file
cp $TEMPLATE $INPUTFILE

# Replace names etc.
sed -i "s/companyName/${NAME}/g" $INPUTFILE
sed -i "s/companyTagline/The best there is \- ${NAME}/g" $INPUTFILE
sed -i "s/companyWebsite/http\:\/\/${TAG}.com/g" $INPUTFILE
sed -i "s/companyEmail/${EMAIL}/g" $INPUTFILE
sed -i "s/companyPassword/${PW}/g" $INPUTFILE

psql -h erp.futurality.fi -U openerp -d postgres -c "CREATE DATABASE ${DB}"
psql -h erp.futurality.fi -U openerp -d $DB < $INPUTFILE