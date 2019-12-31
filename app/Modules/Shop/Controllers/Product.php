<?php

namespace App\Modules\Shop\Controllers;

use App\Http\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Modules\Shop\Repository\Product as ProductRepository;
use App\Modules\Shop\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class Product
 * @package App\Modules\User\Controllers
 */
class Product extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * Product constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetchSingle(Request $request)
    {
        $query = $request->query();
        $product = $this->productRepository->fetchProduct($query);

        if (!$product) {
            return response()->json(["product" => "not found"])->setStatusCode(404);
        }

        return response()->json(['product' => new ProductResource($product)], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetch(Request $request)
    {
        $query = $request->query();
        $limit = isset($query['limit']) ? (int)$query['limit'] : 30;
        $offset = isset($query['offset']) ? (int)$query['offset'] : 0;
        $products = $this->productRepository->fetchProducts([], ['id', 'DESC'], $limit, $offset);
        return response()->json(['products' => ProductResource::collection($products)], 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function delete(Request $request, $id)
    {
        $product = $this->productRepository->fetchProduct([
            "id" => $id
        ]);

        if (!$product) {
            return response()->json(["product" => "not found"])->setStatusCode(404);
        }

        $this->productRepository->delete($product);
        return response()->json(['success' => true], 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function edit(Request $request, $id)
    {
        $product = $this->productRepository->fetchProduct([
            "id" => $id
        ]);

        if (!$product) {
            return response()->json(["product" => "not found"])->setStatusCode(404);
        }

        $validatedData = Validator::make($request->all(), [
            'name' => 'nullable|min:3',
            'slug' => 'nullable|min:3',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'sku' => 'nullable',
            'barcode' => 'nullable',
            'instock' => 'nullable|boolean',
            'discount_type_percent' => 'nullable|boolean',
            'discount' => 'nullable|integer',
            'discount_start_date' => 'nullable|integer',
            'discount_end_date' => 'nullable|integer',
            'include_taxes' => 'nullable|boolean',
            'length_units' => 'nullable',
            'weight_units' => 'nullable',
            'length' => 'nullable',
            'width' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'status' => 'nullable|boolean',
        ]);

        if (count($validatedData->errors()->getMessages()) > 0) {
            return response()->json($validatedData->errors()->getMessages())->setStatusCode(400);
        }

        $product = $this->productRepository->update($product, $request->all());
        return response()->json(['product' => new ProductResource($product)], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'sku' => 'nullable',
            'barcode' => 'nullable',
            'instock' => 'nullable|boolean',
            'discount_type_percent' => 'nullable|boolean',
            'discount' => 'nullable|integer',
            'discount_start_date' => 'nullable|integer',
            'discount_end_date' => 'nullable|integer',
            'include_taxes' => 'nullable|boolean',
            'length_units' => 'nullable',
            'weight_units' => 'nullable',
            'length' => 'nullable',
            'width' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'status' => 'nullable|boolean',
        ]);

        if (count($validatedData->errors()->getMessages()) > 0) {
            return response()->json($validatedData->errors()->getMessages())->setStatusCode(400);
        }

        $product = $this->productRepository->insert(array_merge($request->all(), [
            "created_by" => Auth::user()->id
        ]));

        return response()->json(['product' => new ProductResource($product)], 200);
    }
}
