<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PhoneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function createEntity(string $entityFqcn)
    {
        /** @var Categorie $phoneCategorie */
        $phoneCategorie =$this->getDoctrine()->getRepository(Categorie::class)->find(1);

        $product = new Produit();
        $product->setCategorie($phoneCategorie);

        return $product;
    }
    public function configureFields(string $pageName): iterable
    {
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find(1);
        $imageFile =  TextareaField::new('imageFile')->setFormType(VichImageType::class);
        $image =    ImageField::new('image')->setBasePath('images/product_images');
        $fields = [
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
