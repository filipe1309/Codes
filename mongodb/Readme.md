MongoDB
====

Comandos:
----
	Instalação:
			Debian:
				//sudo apt-get install mongodb
			Fedora:
				yum  install mongodb mongodb-server
				service mongod start // Inicia mongodb
				systemctl status mongod.service // Verificar 
				systemctl enable mongod.service // Iniciar no boot
	Início:
		sudo service mongod start
		mongo
		show dbs
		use [db]
			show collections
