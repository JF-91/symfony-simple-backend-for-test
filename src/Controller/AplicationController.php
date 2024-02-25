<?php

namespace App\Controller;

use App\Entity\Product;
use App\Factory\ProductFactory;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AplicationController extends AbstractController
{

    private ManagerRegistry $managerRegistry;
    private ProductFactory $productFactory;

    public function __construct(ManagerRegistry $managerRegistry, ProductFactory $productFactory) {
        $this->managerRegistry = $managerRegistry;
        $this->productFactory = $productFactory;
    }

    #[Route('/products', name: 'products', methods: [Request::METHOD_GET])]
    public function index():JsonResponse
    {
        $this->managerRegistry->getManager()->getRepository(Product::class)->findAll();

        $data = [
            'status' => 200,
            'message' => 'Success',
            'data' => $this->managerRegistry->getManager()->getRepository(Product::class)->findAll()
        ];

        return new JsonResponse($data, 200);
    }

    #[Route('/products/{id}', name: 'products_show', methods: [Request::METHOD_GET])]
    public function show(int $id):JsonResponse
    {
        $product = $this->managerRegistry->getManager()->getRepository(Product::class)->find($id);

        if (!$product) {
            $data = [
                'status' => 404,
                'message' => 'Product not found',
                'data' => []
            ];
            return new JsonResponse($data, 404);
        }

        $data = [
            'status' => 200,
            'message' => 'Success',
            'data' => $product
        ];

        return new JsonResponse($data, 200);
    }

    #[Route('/products', name: 'products_create', methods: [Request::METHOD_POST])]
    public function create(Request $request):JsonResponse
    {
        $productType = ProductTypeEnum::fromString($request->request->get('type'));
        $product = $this->productFactory->create($productType, $request->request->get('name'), $request->request->get('description'), $request->request->get('price'));

        $this->managerRegistry->getManager()->persist($product);
        $this->managerRegistry->getManager()->flush();

        $data = [
            'status' => 201,
            'message' => 'Product created',
            'data' => $product
        ];

        return new JsonResponse($data, 201);
    }

    #[Route('/products/{id}', name: 'products_update', methods: [Request::METHOD_PUT])]
    public function update(int $id, Request $request):JsonResponse
    {
        $product = $this->managerRegistry->getManager()->getRepository(Product::class)->find($id);

        if (!$product) {
            $data = [
                'status' => 404,
                'message' => 'Product not found',
                'data' => []
            ];
            return new JsonResponse($data, 404);
        }

        $productType = ProductTypeEnum::fromString($request->request->get('type'));
        $product = $this->productFactory->create($productType, $request->request->get('name'), $request->request->get('description'), $request->request->get('price'));

        $this->managerRegistry->getManager()->persist($product);
        $this->managerRegistry->getManager()->flush();

        $data = [
            'status' => 200,
            'message' => 'Product updated',
            'data' => $product
        ];

        return new JsonResponse($data, 200);
    }

    #[Route('/products/{id}', name: 'products_delete', methods: [Request::METHOD_DELETE])]
    public function delete(int $id):JsonResponse
    {
        $product = $this->managerRegistry->getManager()->getRepository(Product::class)->find($id);

        if (!$product) {
            $data = [
                'status' => 404,
                'message' => 'Product not found',
                'data' => []
            ];
            return new JsonResponse($data, 404);
        }

        $this->managerRegistry->getManager()->remove($product);
        $this->managerRegistry->getManager()->flush();

        $data = [
            'status' => 200,
            'message' => 'Product deleted',
            'data' => []
        ];

        return new JsonResponse($data, 200);
    }

}
