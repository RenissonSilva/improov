conf:
	sudo apt-get install php8 php8-mbstring php8-mysql php8-intl php8-xml composer
	composer install --no-scripts
	cp .env.example .env
	php artisan key:generate
	sudo apt-get install mysql-server-5.7
	$(MAKE) bd-conf

composer:
	composer install --no-scripts
	cp .env.example .env
	php artisan key:generate
	$(MAKE) bd-conf

Windows:
	composer install --no-scripts
	copy .env.example .env
	php artisan key:generate
	sed -i 's/DB_DATABASE.*/DB_DATABASE=improov/' .env
	sed -i 's/DB_USERNAME.*/DB_USERNAME=root/' .env
	sed -i 's/DB_PASSWORD.*/DB_PASSWORD=/' .env
	sed -i 's/MAIL_ENCRYPTION.*/MAIL_ENCRYPTION=tls/' .env

erickson:
	git config user.email "erickson.rinho@hotmail.com"
	git config user.name "Erickson"


bd-conf:
	mysql -u root -p --execute="drop database if exists improov; create database improov; drop user if exists 'improov'; create user 'improov' identified by 'improov'; grant all privileges on improov.* to 'improov';"
	sed -i 's/DB_DATABASE.*/DB_DATABASE=improov/' .env
	sed -i 's/DB_USERNAME.*/DB_USERNAME=improov/' .env
	sed -i 's/DB_PASSWORD.*/DB_PASSWORD=improov/' .env
	sed -i 's/MAIL_ENCRYPTION.*/MAIL_ENCRYPTION=tls/' .env
	php artisan migrate:refresh --seed
