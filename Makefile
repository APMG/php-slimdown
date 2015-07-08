.PHONY: test docs

test:
		vendor/bin/phpunit tests/*

docs:
		vendor/bin/phpdoc -d ./lib -t ./docs
