SHELL := /bin/bash

# Generic functions
define update_service
	@echo -e  "> Updating service: \033[0;32m$(1)\033[0m"
	@echo -e
	@docker-compose exec $(1) composer install
endef

define doctrine_init_service
	@echo -e  "> Setting up service \033[0;32m$(1)\033[0m database schema"
	@echo -e
	@docker-compose exec $(1) sh -c 'php bin/console doctrine:database:create --if-not-exists'
	@docker-compose exec $(1) sh -c 'php bin/console doctrine:schema:create'
endef

define doctrine_update_service
	@echo -e  "> Updating service \033[0;32m$(1)\033[0m database schema"
	@echo -e
	@docker-compose exec $(1) sh -c 'php bin/console doctrine:schema:update --force'
endef

define fix_service_permissions
	@echo -e  "> Fixing service \033[0;32m$(1)\033[0m permissions"
	@echo -e
	@docker-compose exec $(1) sh -c 'chown -R root:root /app || true'
endef

# Development
warmup:
	@echo -e "> \033[0;32mWarmup\033[0m"
	@docker-compose up -d

start: warmup
	@echo -e "> \033[0;32mStart\033[0m"
	$(eval HAPROXY_IP=$(shell sh -c "docker-compose exec haproxy sh -c 'hostname -i | cut -d\  -f1'"))
	@HAPROXY_IP=$(HAPROXY_IP) docker-compose up -d
	@echo -e "> \033[0;32mDone\033[0m"

scale-up:
	$(eval HAPROXY_IP=$(shell sh -c "docker-compose exec haproxy sh -c 'hostname -i | cut -d\  -f1'"))
	@HAPROXY_IP=$(HAPROXY_IP) docker-compose up -d
	docker-compose scale football-match-service=3
	docker-compose scale relation-service=3
	docker-compose scale team-service=3
	@HAPROXY_IP=$(HAPROXY_IP) docker-compose scale user-proxy-service=3
	@echo Waiting for services to start...
	docker-compose stop haproxy
	docker-compose rm --force haproxy
	HAPROXY_CFG='haproxy-scaled.cfg' docker-compose up --no-deps -d haproxy
	@echo -e "> \033[0;32mDone\033[0m"

stop:
	@docker-compose stop
	@echo -e "> \033[0;32mDone\033[0m"

restart:
	make stop
	@echo
	make start

recreate:
	@docker-compose down
	@make start

update:
	$(call update_service,user-proxy-service)
	$(call update_service,football-match-service)
	$(call update_service,team-service)
	$(call update_service,relation-service)

doctrine-init:
	$(call doctrine_init_service,user-proxy-service)
	$(call doctrine_init_service,relation-service)
	$(call doctrine_init_service,football-match-service)
	$(call doctrine_init_service,team-service)

doctrine-update:
	$(call doctrine_update_service,user-proxy-service)
	$(call doctrine_update_service,football-match-service)
	$(call doctrine_update_service,team-service)
	$(call doctrine_update_service,relation-service)

fix-service-permissions:
	$(call fix_service_permissions,football-match-service)
	$(call fix_service_permissions,team-service)
	$(call fix_service_permissions,relation-service)

run-tests:
	@docker-compose exec user-proxy-service sh -c "php bin/behat"
