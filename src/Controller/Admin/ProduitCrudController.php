<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\Serie;
use App\Repository\MarqueRepository;
use Container7x5mAjH\getRedirectControllerService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\File;

class ProduitCrudController extends AbstractCrudController
{

    private Request $request;

    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    private $adminUrlGenerator;


    public function configureFields(string $pageName): iterable
    {
        $imageFile =  TextareaField::new('imageFile')->setFormType(VichImageType::class);
        $image =    ImageField::new('image')->setBasePath('images/product_images');

        $fields  = [
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






    /**
     * @var \App\Entity\Marque[]
     */
    private array $marques;



    public function __construct(Environment $twig, EntityManagerInterface $entityManager, MarqueRepository $marqueRepository)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $marques =  $marqueRepository->findAll();
        $this->marques = $marques;
        $this->request = new Request(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
    }



    /**
     * @Route("/addMultiplePhone", name="addMultiplePhone")
     */
    public function addMultiplePhone(){
        $marque = $this->getDoctrine()->getRepository(Marque::class)->find(3);
        $serie = $this->getDoctrine()->getRepository(Serie::class)->find(22);
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find(2);
    if($this->request->get('validationBtn') == "valid"){
        for ($x = 0; $x < count($this->request->get('ajoutPhone')['model']); $x++) {
            if($this->request->get('ajoutPhone')['model'][$x] != null or $this->request->get('ajoutPhone')['model'][$x] != ""){
                $model = $this->request->get('ajoutPhone')['model'][$x];
                $phone = new Produit();
                $phone->setModel($model);
                $phone->setMarque($marque);
                $phone->setSerie($serie);
                $phone->setCategorie($categorie);
                $this->entityManager->persist($phone);
                $this->entityManager->flush($phone);
            }
        }
    }
        return $this->render('admin/phone/addMultiplePhone.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,
            'marque' =>$marque,
            'serie' => $serie,
        ]);
    }


    /**
     * @Route("/addAutomaticImgages", name="addAutomaticImgages")
     */
    public function addAutomaticImgages(){
        $analyseTable = $this->configureImage();
        dd($analyseTable);

    }


    /**
     * @Route("/test5")
     */
    public function findPhotoName(){
        $pathOfThis =  dirname(__FILE__);
        $pathOfApp = str_replace('\\', '/', $pathOfThis);
        $pathOfApp = str_replace('src/Controller/Admin', '', $pathOfApp);
        $pathOfImage = $pathOfApp."assets/images/product_images";
        $nameOfImages = [];
        if ($handle = opendir($pathOfImage)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {

                    $nameOfImages [] = $entry;
                }
            }
            closedir($handle);
        }
        return $nameOfImages;
    }

    public function configureImage(){
        $phones = $this->getDoctrine()->getRepository(Produit::class)->findBy([
            'image' => null
        ]);

        $counter= 0;

        $nomImages = $this->findPhotoName();
        $tabPourcentage = array();
        $analyseTable = array();


        foreach ($phones as $phone){

            $nom = $phone->getSerie().$phone->getModel();
            $nom = str_replace(' ', '', $nom);
//            dump($nom." "."----------");
            foreach ($nomImages as $imageSearch){
                similar_text($nom, $imageSearch, $perc);

                $tabPourcentage [] = $perc;
            }
            $maxPourcent =   max($tabPourcentage);

            foreach ($nomImages as $imageSearch){
                    similar_text($nom, $imageSearch, $perc);

                    if($perc == $maxPourcent){
                        $counter = $counter + 1;

                        $imageName = $imageSearch;
//                        $imageFile = new File("/home/samuinfo/yavuzcanozak.samu-info.com/reparAndGoApp/assets/images/product_images/".$imageName);
                        $phone->setImage($imageName);
                        $phone->setUpdatedAt(new \DateTime('now'));
//                        $phone->setImageFile($imageFile);
                        $this->entityManager->persist($phone);
                        $this->entityManager->flush();

                        $analyseTable[] = [
                            "phone" => $phone->getSerie()." ".$phone->getModel(),
                            "imageName_path" => $imageName,
                            "imageName_name" => $imageName,
                            "pourcentage" => $perc,
                        ];
                    }
                }
        }
//        dump($counter);
        return $analyseTable;
    }
}
