install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR12 src bin tests

test:
	./vendor/bin/phpunit tests