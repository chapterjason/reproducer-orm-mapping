
# Reproduce

```shell
cd App
composer update
symfony console doctrine:schema:update --dump-sql
```

Output:

```shell
$ symfony console doctrine:schema:update --dump-sql
In MappingException.php line 94:
                                                       
  Class 'Acme\Bundle\User\Entity\User' does not exist  
                                                       

doctrine:schema:update [--em EM] [--complete] [--dump-sql] [-f|--force]

exit status 1
```
