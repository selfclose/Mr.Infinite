## **WP_Infinite (beta Unstable)**
Create Wordpress plugin in MVC(Kind of) + CRUD in simple (maybe odd) way
It's gonna looks alike Laravel.

[![GitHub version](https://d25lcipzij17d.cloudfront.net/badge.svg?id=gh&type=6&v=0.1.2&x2=0)](#)
[![WordPress](https://img.shields.io/wordpress/v/akismet.svg)]()

_it_531413016@hotmail.com_

First You need to know this vendor help you manage your data spread table from wp_posts or wp_meta..

Use autoload (PSR-0) and [Redbean](http://www.redbeanphp.com/) for ORM

### Requirement:
* Wordpress (of course)
* phpstorm (just recommend for good autocomplete)
* Composer
* Jade or Pug (not important) For make fast and flexable UI

#### Turn you back on Database
* We CREATE TABLE By class name But...
* No worry about manage table, It's automatic CREAT, ALTER table or change TYPE of columns
* Create t

It's not fully MVC, but it can make things easier, because We do same thing all the time.

I'm serious about file size, so I avoid large ORM or framework that's have a bunch of unused code.



### How to begin
1. Create your plugin.
2. require this vendor.
3. Ok, Ready to go.

#### Model
_/wp-content/plugins/my-plugin/src/MyProject/Model/Book.php_
```php
<?php
namespace MyProject\Model;

class Book extends ModelController
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->model->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->model->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->model->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->model->price = $price;
    }
}
```

It's will automatically create table by class name (in lower case).

What if you want to custom table name? Just add property...

```php
    protected $table = 'book';
```


**Model In Action**

###### Insert
```php
<?php
$book = new \MyProject\Model\Book();
$book->setName('Harry Potter');
$book->setPrice(1200);
$book->insertAction();
```

You may notics 'insertAction();' and it's going to do couple thing
Yes, It will automatic create table, take care column type and insert record for you. thanks for readbean.

**And another command**
* ->insertAction();
* ->updateAction();
* ->deleteAction();
* ->readAction();
* ->readOneByAction();
* ->findAllAction();
* ->findOneByAction();
* ->countAction();

###### Read
```php
<?php
$book = new \MyProject\Model\Book();
$book->readAction(5);   //read id 5
echo $book->getName();
echo $book->getPrice();

```

_CONTINUE WRITE SOON_
###### Delete
```php
<?php
$book = new \MyProject\Model\Book();
if ($book->deleteAction(3))
    echo "Deleted!";
else
    echo "Can't Delete";
```

**CRUD Action also return bool or object you can retrieve and make condition too**
```php
<?php
$idToRead = 2;
$book = new \MyProject\Model\Book();
if ($book->readAction($idToRead)) {
    //Do stuff
} else {
    echo 'Can\'t read ID: '.$idToRead;
}

```

### Other Ability
* Paginate (php / jQuery with ajax)
* Ajax Provider: Jquery and AngularJS
