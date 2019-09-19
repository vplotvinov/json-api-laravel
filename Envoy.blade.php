@setup
    if ($env === 'prod') {
        $path = '/var/www/backend';
        $branch = 'master';
    }

    if ($env === 'stage') {
        $path = '/var/www/stage-backend';
        $branch = 'stage';
    }

    $release = $path . '/release';
    $repo = '';
    $slackHook = '';
    $projectName = 'Backend';
@endsetup

@servers(['web' => ['root@0.0.0.0']])

@task('init', ['confirm' => true])
    rm -rf {{ $path }}
    mkdir {{ $path }}
    echo "Project directory cleaned"
    rm -rf {{ $release }}
    mkdir {{ $release }}
    git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
    mv {{ $release }}/storage {{ $path }}/storage
    sudo chown -R www-data:www-data {{ $path }}/storage
    echo "Storage directory set up"
	echo "Run 'envoy run deploy --env=...' now."
@endtask

@story('deploy')
	deploymentStart
    deploymentLinks
    deploymentComposer
    deploymentCacheAndFolder
    deploymentMigrate
@endstory

@task('deploymentStart')
	cd {{ $path }}
	echo "Deployment started"
    rm -rf {{ $release }}
    mkdir {{ $release }}
    git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
	echo "Repository cloned"
    rm -f {{ $path }}/.env
    cp {{ $release }}/.env.{{ $env }} {{ $path }}/.env
    echo ".env config created"
@endtask

@task('deploymentLinks')
	cd {{ $path }}
	rm -rf {{ $release }}/storage
	ln -s {{ $path }}/storage {{ $release }}/storage
	ln -s {{ $path }}/storage/public {{ $release }}/public/storage
	echo "Storage directories set up"
	ln -s {{ $path }}/.env {{ $release }}/.env
	echo "Environment file set up"
@endtask

@task('deploymentComposer')
	echo "Installing composer depencencies..."
	cd {{ $release }}
	composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader
@endtask

@task('deploymentMigrate')
    echo "Migrating... ಠᴗಠ"
    php {{ $release }}/artisan migrate --env={{ $env }}
@endtask

@task('deploymentCacheAndFolder')
	php {{ $release }}/artisan cache:clear --quiet
	php {{ $release }}/artisan config:cache --quiet
    echo "Cache cleared"

	php {{ $release }}/artisan queue:restart --quiet
	echo "Queue restarted"

    rm -rf {{ $path }}/current
    mkdir {{ $path }}/current
    cp -a {{ $release }}/. {{ $path }}/current
    echo "Folder moved"
@endtask
