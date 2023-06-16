<?php

namespace App\Repository;

use App\Contracts\MenuRepositoryInterface;
use App\Models\Menu;
use App\Traits\TranslitTrait;
use Exception;
use Illuminate\Http\Request;

class MenuRepository implements MenuRepositoryInterface
{
    private Menu $menu;
    use TranslitTrait;


    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }


    public function index(): array
    {
        $menu = $this->menu->where(['user_id' => auth()->user()->id])->get();
        return ['menu' => $menu];
    }

    /**
     * @throws Exception
     */
    public function get($id): array
    {
        $menu = $this->menu->where(['id' => $id, 'user_id' => auth()->user()->id])->first();
        if(!$menu){
            throw new Exception(__('main.menu.not_found'));
        }
        return ['menu' => $menu];
    }


    /**
     * @throws Exception
     */
    public function create(Request $request): array
    {

        $menu = $this->menu->create([
            'rate_id' => $request->rate_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'slug' => $this->translit($request->name),
            'image' => $request->image ?? null,
        ]);

        if(!$menu){
            throw new Exception(__('main.system.system_error'));
        }

        return ['menu' => $menu];
    }


    /**
     * @throws Exception
     */
    public function update(Request $request, $id): array
    {
        $menu = $this->menu->where(['id' => $id, 'user_id' => auth()->user()->id])->first();
        if(!$menu){
            throw new Exception(__('main.menu.not_found'));
        }
        $menu->name = $request->name;
        $menu->slug = $this->translit($request->name);
        $menu->image = $request->image ?? null;
        if(!$menu->save()){
            throw new Exception(__('main.system.system_error'));
        }
        return ['menu' => $menu];
    }

    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        $menu = $this->menu->where(['id' => $id, 'user_id' => auth()->user()->id])->first();
        if(!$menu){
            throw new Exception(__('main.menu.not_found'));
        }
        if(!$menu->delete()){
            throw new Exception(__('main.system.system_error'));
        }
        return ['menu' => $menu];
    }

}
