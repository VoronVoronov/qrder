<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\MenuCreateRequest;
use App\Http\Requests\Menu\MenuUpdateRequest;
use App\Repository\MenuRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ResponsesTrait;

class MenuController extends Controller
{
    public ResponsesTrait $response;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function index(MenuRepository $menuRepository): JsonResponse
    {
        try{
            return $this->response->success($menuRepository->index(), 'Меню', Response::HTTP_OK);
        } catch (Exception) {
            return $this->response->error('Системная ошибка. Попробуйте позже', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get(MenuRepository $menuRepository, $id): JsonResponse
    {
        try{
            return $this->response->success($menuRepository->get($id), 'Меню', Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->response->error($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function create(MenuCreateRequest $request, MenuRepository $menuRepository): JsonResponse
    {
        try{
            $created = $menuRepository->create($request);
            return $this->response->success($created['menu'], 'Меню создано', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->response->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(MenuUpdateRequest $request, MenuRepository $menuRepository, $id): JsonResponse
    {
        try{
            $updated = $menuRepository->update($request, $id);
            return $this->response->success($updated['menu'], 'Меню обновлено', Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->response->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(MenuRepository $menuRepository, $id): JsonResponse
    {
        try{
            $menuRepository->delete($id);
            return $this->response->success(null, 'Меню удалено', Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->response->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
