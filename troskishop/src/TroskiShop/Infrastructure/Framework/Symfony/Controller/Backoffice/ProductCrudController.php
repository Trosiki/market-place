<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Backoffice;

use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use TroskiShop\Domain\Model\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nombre del producto'),
            TextField::new('brand', 'Marca'),
            TextField::new('model', 'Modelo'),
            NumberField::new('price', 'Precio €'),
            TextField::new('image', 'Foto del producto'),
            TextField::new('description', 'Detalle corto del producto'),
            TextEditorField::new('specification', 'Especificación detallada'),
            TextField::new('uri'),
            BooleanField::new('active')
        ];
    }
}
