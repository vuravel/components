<?php

namespace Vuravel\Components;

use Vuravel\Catalog\Cards\TableRow;
use Vuravel\Catalog\Catalog;

class TableCatalog extends Catalog
{
    public $layout = 'Table';
    public $card = TableRow::class;
}
