## **WP_Infinite (beta Unstable)**
Create Wordpress plugin with MVC(Kind of) + CRUD in simple or maybe indy way
It's gonna looks alike Laravel.

[![GitHub version](https://d25lcipzij17d.cloudfront.net/badge.svg?id=gh&type=6&v=0.1.2&x2=0)](#)
[![WordPress](https://img.shields.io/wordpress/v/akismet.svg)]()

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
* In 'include.php' there is config.
* Each file will tell how it's work.
* Example model (src/RB/Model) that's extends from Controller.

### Ability
* CRUD make more simple through model
* ReadAll
* Count
* json_encode
* Paginate (php / jQuery with ajax)

_it_531413016@hotmail.com_

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
$idToDelete = 1;
$book = new \RB\Model\Book($idToDelete);
if ($book->deleteAction()) {
    echo "ID: ".$idToDelete." is Deleted!";
} else {
    echo "Can't Delete(or no id): ".$idToDelete;
}
```

###### Display (Where id style)
```php
<?php
$idToRead = 2;
$book = new \RB\Model\Book($idToRead);
if ($book->readAction()) {
?>
    <p>ID: <?=$book->getId()?></p>
    <p>Name: <?=$book->getName()?></p>
    <p>price: <?=$book->getPrice()?></p>
<?php
} else {
    echo 'Can\'t read ID: '.$idToRead;
}

//--OR--
$book = new \RB\Model\Book();
if ($book->readAction(5)) {
?>
    ...
<?php
} else {
    ...
}

```

Another thing in project.

<hr/>
###Relation Keyword (I May wrong)
* Example Dummy is table name

one-to-many: "own"

```php
//Library
$this->dataModel->ownBook = \R::load('book', 1);
```

many-to-one: 

```php
//Library
$this->dataModel->book_id = 2;
```

many-to-many: "shared"

```php
//Book
$this->dataModel->sharedAuthor = \R::load('author', 1);
```
<hr/>

#### Retrieve Relation object

* Model - SkillType

###### (little trick: I'm use annotation of column for easier to retrieve properties when foreach)

```php
/**
 * @property int|array id
 * @property string name
 * @property array sharedSkill
 */
class SkillType extends RedBeanController
{
    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->dataModel->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->dataModel->name = $name;
    }

    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->dataModel->sharedSkill;
    }

    /**
     * @param $skills array Skill
     */
    public function setSkills($skills)
    {
        unset($this->dataModel->sharedSkill);
        if (is_array($skills)) {
            foreach ($skills as $skill) {
                $this->dataModel->sharedSkill[] = \R::load('skill', $skill);
            }
        }
    }

    public function addSkill($skill)
    {
        $this->dataModel->sharedSkill[] = \R::load('skill', $skill);
        iLog($skill);
    }
}
```

* Skill Class is the same but only get, set Name

* Display

```php
        /**
         * @var $skType SkillType
         */
        foreach ($skillType->readAllAction() as $skType) {

            echo "<p>* {$skType->name}</p>";

            /**
             * @var $sk Skill
             */
            foreach ($skType->sharedSkill as $sk) {

                echo "<p> {$sk->id}--{$sk->name}</p>";
            }
        }
```
