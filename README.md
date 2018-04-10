Core WordPress
==============

### Database Setup

1. Create WordPress databases:
	```
	core
	```

	_Use the Unicode multi-byte encoding `utf8mb4`_

2. Set permissions using the credentials set here:  
	`/src/wp-config.php`


### Back-End Setup

1. Configure your web server (and PHP 5.6+) to serve the `dist/` web root, for example:
	`http://local.domain.com`

2. From a Terminal, change to the repo’s root directory where you see `src/`. From here, you’ll need to install Composer to manage PHP packages:
	```
	curl -sS https://getcomposer.org/installer | php
	```

	If you’re using Windows, more complex instructions are required:
	https://getcomposer.org/doc/00-intro.md#installation-windows

3. Install the Composer packages:
	```
	php composer.phar install
	```


### Front-End Setup

1. Install Node.JS

2. Install Gulp globally (as root/adminstrator):

	```
	npm install -g gulp-cli
	```

3. Install dependencies automatically by running:
	```
	npm install
	```

4. All files for deployment copied to `/dist/`
	```
	php composer.phar install && npm run build
	```

5. Output a development build, proxied via BrowserSync
	```
	php composer.phar install && npm run dev
	```

	_This will launch start a local proxy to `http://local.domain.com` so any code changes will be live-reloaded using BrowserSync into all your open browsers (including mobiles)_


### WordPress Setup

1. Visit `http://local.domain.com` and follow the 5-minute install process

2. Set the Permalink Settings to **Custom Structure**  
	```
	/%category%/%postname%/
	```

3. Set the theme to **Core WordPress**
