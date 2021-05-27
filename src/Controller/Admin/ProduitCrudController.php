<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\File;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }



    public function configureFields(string $pageName): iterable
    {
        $imageFile =  TextareaField::new('imageFile')->setFormType(VichImageType::class);
        $image =    ImageField::new('image')->setBasePath('images/product_images');
        $fields = [
            AssociationField::new('categorie'),
            AssociationField::new('marque'),
            AssociationField::new('serie'),
            TextField::new('model'),

        ];
        if($pageName == Crud::PAGE_INDEX ||$pageName == Crud::PAGE_DETAIL){
            $fields [] = $image;
        }else{
            $fields [] = $imageFile;
        }

        return $fields;
    }
}
