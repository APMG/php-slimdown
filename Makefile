.PHONY: test docs

test:
		vendor/bin/phpunit

docs:
		vendor/bin/phpdoc -d ./lib -t ./docs
