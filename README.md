# PHP + Neo4j Spatial Plugin

Quick and dirty sample code for using the [Neo4j Spatial Plugin](https://github.com/neo4j-contrib/spatial) 
with [Graph Story](http://graphstory.com).

The Neo4j Spatial plugin comes standard on all Graph Story plans.

## Installation

* Clone the repo
* Run `composer install`
* Copy `secret.php.dist` to `secret.php`
    * Your Graph Story Neo4j instance credentials can be found at http://console.graphstory.com.
    * A tailored copy of the `secret.php` file can be found in the Graph Kit for PHP docs, also at http://console.graphstory.com.

## Usage

* To set up the spatial index, etc, run `spatial-setup.php` from the command line:

```
$ php /path/to/spatial-setup.php
```

* To run a sample spatial query, run `spatial-queries.php` from the command line:

```
$ php /path/to/spatial-queries.php
```

### Tip

Use the Clear and Refresh functionality in the Graph Story console to wipe your
graph and start over, if needed.
