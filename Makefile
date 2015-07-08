.PHONY: test docs

test:
		vendor/bin/phpunit --coverage-html coverage tests/*

docs:
		vendor/bin/phpdoc -d ./lib -t ./docs
