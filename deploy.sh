USERNAME=poweruser
SERVER="srvz-webapp.he-arc.ch"
PORT=2261

git checkout deploy
git merge master
git push
ssh ${USERNAME}@${SERVER} -p${PORT} 'cd /var/www/app/ ; git checkout deploy ; git stash ; git stash drop ; git pull ; npm install ; composer install --no-dev ; npm run production'
