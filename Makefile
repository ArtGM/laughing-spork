ifneq (,$(findstring feature-,$(BRANCH)))
	TEMP_NAME=$(subst $(findstring feature-,$(BRANCH)),feature/,$(BRANCH))
else
	TEMP_NAME=$(BRANCH)
endif
ifneq (,$(findstring release-,$(TEMP_NAME)))
	BRANCH_NAME=$(subst $(findstring release-,$(TEMP_NAME)),release/,$(TEMP_NAME))
else
	BRANCH_NAME=$(TEMP_NAME)
endif

.PHONY: fix
fix:
	symfony php vendor/bin/phpstan analyze src/ --memory-limit=-1
	symfony php vendor/bin/rector process src/ tests/

.PHONY: vendor
analyze:
	yarn audit
	symfony composer valid
	symfony php bin/console doctrine:schema:valid --skip-sync
	symfony php bin/console lint:twig templates/
	symfony php bin/console lint:xliff translations/

.PHONY: tests
tests-coverage:
	XDEBUG_MODE=coverage symfony php vendor/bin/phpunit --coverage-html test-coverage/

debug-tests:
	symfony console cache:clear --env=test
	symfony php bin/phpunit --testdox

tests:
	symfony php bin/phpunit

fixtures-test:
	symfony php bin/console doctrine:fixtures:load -n --env=test

fixtures-dev:
	symfony console doctrine:fixtures:load -n --env=dev

database-test:
	symfony console doctrine:database:drop --if-exists --force --env=test
	symfony console doctrine:database:create --env=test
	symfony console doctrine:schema:update --force --env=test

database-dev:
	symfony console doctrine:database:drop --if-exists --force --env=dev
	symfony console doctrine:database:create --env=dev
	symfony console doctrine:schema:update --force --env=dev

migrations-dev:
	symfony console doctrine:migrations:diff --no-interaction --env=dev
	symfony console doctrine:migrations:migrate --no-interaction --env=dev

prepare-test:
	make database-test
	make fixtures-test

prepare-dev:
	make database-dev
	make fixtures-dev

prepare-build:
	make database-test
	make fixtures-test
	yarn dev

install:
	cp .env .env.test
	echo 'KERNEL_CLASS="App\Kernel"' >> .env.test
	sed -i -e 's/`BRANCH/$(BRANCH)/' .env.test
	sed -i -e 's/USER/$(DATABASE_USER)/' .env.test
	sed -i -e 's/PASSWORD/$(DATABASE_PASSWORD)/' .env.test
	composer install
	yarn install --force
.PHONY: install

deploy-dev:
	symfony composer update
	symfony console doctrine:migration:diff --no-interaction
	symfony console doctrine:migration:migrate --no-interaction
	yarn install --force
	yarn dev