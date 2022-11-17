@servers(['morplees' => ['morplees.com@morplees.com']])

@task('staging')
	echo " -- Starting Staging task"
	
	echo " -- Moving to Staging directory"
	cd ~/projects/staging
	pwd

	echo " -- Updating Repo from Origin"
	git checkout staging
    git pull

    echo " -- Running Composer Install"
    ../composer.phar install --no-dev

	echo " -- Running Artisan Migrate"
    php artisan migrate --force

	echo " -- Clearing Caches"
	php artisan cache:clear
	php artisan route:clear
	php artisan config:clear
	php artisan view:clear

	echo " -- Finished Staging task."

	echo "Are there any new items in /public?"
	echo "Do you need to run:"
	echo "ln -s ~/projects/staging/public/newthing ~/html/staging/newthing"
@endtask

@task('production', ['confirm' => true])
	echo " -- Starting Production task"
	
	echo " -- Moving to Production directory"
	cd ~/projects/production
	pwd

	echo " -- Updating Repo from Origin"
	git checkout production
    git pull

    echo " -- Running Composer Install"
    ../composer.phar install --no-dev

	echo " -- Running Artisan Migrate"
    php artisan migrate --force

	echo " -- Clearing Caches"
	php artisan cache:clear
	php artisan route:clear
	php artisan config:clear
	php artisan view:clear

	echo " -- Finished Production task."

	echo "Are there any new items in /public?"
	echo "Do you need to run:"
	echo "ln -s ~/projects/production/public/newthing ~/html/app/newthing"
@endtask


