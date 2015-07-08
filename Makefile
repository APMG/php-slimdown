.PHONY: test docs

test:
		vendor/bin/phpunit -c tests/phpunit.xml tests/

docs:
		vendor/bin/phpdoc -d ./lib -t ./docs
