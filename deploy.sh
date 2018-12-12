USERNAME=poweruser
SERVER="srvz-webapp.he-arc.ch"
PORT=2261

git checkout deploy
git merge master
git push
ssh ${USERNAME}@${SERVER} -p${PORT} '
cd /var/www/app/ ;
git checkout deploy ;
echo "stashing" ; git stash ;
git stash drop ;
echo "pulling" ; git pull ;
echo "npm install" ; npm install ;
echo "composer install" ; composer install --no-dev ;
echo migrate ; php artisan migrate ;
echo routecache ; php artisan route:cache ;
echo rebuilding-sass ; npm rebuild node-sass ;
echo npmrun ; npm run production'
git checkout master
