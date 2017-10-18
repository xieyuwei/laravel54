clean:
	rm -rd node_modules;

install:
	npm install --registry=https://registry.npm.taobao.org;
	composer install;

run:
	php artisan serve;

migrate:
	php artisan migrate;
