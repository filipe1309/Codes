MongoDB
====

Comandos:
----
	Instalação:
			Debian:
				//sudo apt-get install mongodb
			Fedora:
				/etc/yum.repos.d/mongodb.repo // Criar
					[mongodb]
					name=MongoDB Repository
					baseurl=http://downloads-distro.mongodb.org/repo/redhat/os/x86_64/
					gpgcheck=0
					enabled=1
				sudo yum install mongodb-org
				
				http://docs.mongodb.org/manual/tutorial/install-mongodb-on-red-hat-centos-or-fedora-linux/
				//sudo yum install mongodb
	Início:
		sudo service mongod start
		mongo
		show dbs
		use [db]
			show collections
