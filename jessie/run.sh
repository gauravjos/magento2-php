#!/bin/bash

MAGENTO_HOME=${MAGENTO_HOME:-/var/www/html/magento2.1}
BK_FRONT=${BK_FRONT:-admin_magento}
DB_HOST=${DB_HOST:-127.0.0.1}
DB_NAME=${DB_NAME:-magento}
DB_USER=${DB_USER:-magento}
DB_PASSWD=${DB_PASSWD:-password}
SESSION_SAVE=${SESSION_SAVE:-db}

yes | $MAGENTO_HOME/bin/magento setup:config:set \
--backend-frontname="$BK_FRONT" \
--db-host="$DB_HOST" \
--db-name="$DB_NAME" \
--db-user="$DB_USER" \
--db-password="$DB_PASSWD" \
--session-save="$SESSION_SAVE" \
&& apache2-foreground
