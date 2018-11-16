USERNAME=poweruser
SERVER="srvz-webapp.he-arc.ch"
PORT=2261

ssh ${USERNAME}@${SERVER} -p${PORT} 'cd /var/www/app/ ; git checkout deploy ; git pull ; npm install ; composer install --no-dev ; npm run production'
