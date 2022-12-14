<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleCustomerAssetManagement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = \App\Models\Module::where('name','Customer Asset')->first();
        if(!$module) {
            $module = new \App\Models\Module();
            $module->name = 'Customer Asset';
            $module->status = 1;
            $module->prefix_link = 'customer-asset-management';
            $module->save();
        }
        if($module){
            $menu = \App\Models\ModulesItem::where(['name'=>'Dashboard','module_id'=>$module->id])->first();
            $user = \App\Models\UserAccess::where('name','LIKE',"%Administrator%")->first();

            if(!$menu) {
                $menu = new \App\Models\ModulesItem();
            }
            $menu->module_id = $module->id;
            $menu->name = 'Dashboard';
            $menu->link = 'customer-asset-management.index';
            $menu->status = 1;
            $menu->type = 1;
            $menu->prefix_link = 'dashboard';
            $menu->save();
            if($user){
                $menu_access = \App\Models\UserAccessModule::where(['user_access_id'=>$user->id,'module_id'=>$menu->id])->first();
                if(!$menu_access) $menu_access = new \App\Models\UserAccessModule();
                
                $menu_access->user_access_id = $user->id;
                $menu_access->module_id = $menu->id;
                $menu_access->save();
            }
            // Insert Function
            $item = \App\Models\ModulesItem::where(['module_id'=>$module->id,'name'=>'Upload','link'=>'customer-asset-management.upload','parent_id'=>$menu->id])->first();
            if(!$item) $item = new \App\Models\ModulesItem();
            $item->module_id = $module->id;
            $item->name = 'Upload';
            $item->link = 'customer-asset-management.upload';
            $item->status = 1;
            $item->type = 2;
            $item->parent_id = $menu->id;
            $item->prefix_link = 'upload';
            $item->save();
            if($user){
                $menu_access = \App\Models\UserAccessModule::where(['user_access_id'=>$user->id,'module_id'=>$item->id])->first();
                if(!$menu_access) $menu_access = new \App\Models\UserAccessModule();
                $menu_access->user_access_id = $user->id;
                $menu_access->module_id = $item->id;
                $menu_access->save();
            }
            // Insert Raw Data
            $item = \App\Models\ModulesItem::where(['module_id'=>$module->id,'name'=>'Data','link'=>'customer-asset-management.data'])->first();
            if(!$item) $item = new \App\Models\ModulesItem();
            $item->module_id = $module->id;
            $item->name = 'Data';
            $item->link = 'customer-asset-management.data';
            $item->status = 1;
            $item->type = 1;
            $item->prefix_link = 'data';
            $item->save();
            if($user){
                $menu_access = \App\Models\UserAccessModule::where(['user_access_id'=>$user->id,'module_id'=>$item->id])->first();
                if(!$menu_access) $menu_access = new \App\Models\UserAccessModule();
                $menu_access->user_access_id = $user->id;
                $menu_access->module_id = $item->id;
                $menu_access->save();
            }
        }
    }
}
