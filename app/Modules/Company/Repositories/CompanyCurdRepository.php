<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;

class CompanyCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('Company::company.title'),
            'url' => 'dashboard/'.'companies',
            'name' => 'companies',
            'nameOne' => 'company',
            'modelName' => 'Company',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('Company::company.newOne'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function searchData(): array
    {
        return  [
            'category_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Company::company.form.category'),
                'options' => \App\Entities\Category::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as title"]),
            ],
            'location' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '1',
                'label' => trans('Company::company.form.location'),
            ],
            'email' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '2',
                'label' => trans('Company::company.form.email'),
            ],
            'phone' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '2',
                'label' => trans('Company::company.form.phone'),
            ],
            'status' => [
                'type' => 'toggle',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Dashboard::dashboard.showInActive'),
                'checked' => true,
            ],
            'deleted_at' => [
                'type' => 'toggle',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Dashboard::dashboard.showItems'),
                'checked' => false,
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function tableData()
    {
        return [
            'id' => [
                'label' => trans('Dashboard::dashboard.id'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
            'name_ar' => [
                'label' => trans('Company::company.form.name_ar'),
                'type' => '',
                'className' => '',
                'data-col' => 'name_ar',
                'anchor-class' => '',
            ],
//            'name_en' => [
//                'label' => trans('Company::company.form.name_en'),
//                'type' => '',
//                'className' => '',
//                'data-col' => 'name_en',
//                'anchor-class' => '',
//            ],
            'category_name' => [
                'label' => trans('Company::company.form.category'),
                'type' => '',
                'className' => '',
                'data-col' => 'category_id',
                'anchor-class' => '',
            ],
            'location' => [
                'label' => trans('Company::company.form.location'),
                'type' => '',
                'className' => '',
                'data-col' => 'location',
                'anchor-class' => '',
            ],
            'phone' => [
                'label' => trans('Company::company.form.phone'),
                'type' => '',
                'className' => '',
                'data-col' => 'phone',
                'anchor-class' => '',
            ],
            'email' => [
                'label' => trans('Company::company.form.email'),
                'type' => '',
                'className' => '',
                'data-col' => 'email',
                'anchor-class' => '',
            ],
            'status' => [
                'label' => trans('Company::company.form.status'),
                'type' => '',
                'className' => '',
                'data-col' => 'status',
                'anchor-class' => '',
            ],
            'actions' => [
                'label' => trans('Dashboard::dashboard.actions'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function addData()
    {
        return[
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function editData()
    {
        return[
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function getSpecificData($types=[])
    {
        $data = [];
        if(in_array('main',$types)){
            $data['mainData'] = $this->mainData();
        }

        if(in_array('search',$types)){
            $data['searchData'] = $this->searchData();
        }

        if(in_array('table',$types)){
            $data['tableData'] = $this->tableData();
        }

        if(in_array('add',$types)){
            $data['modelData'] = $this->addData();
        }

        if(in_array('edit',$types)){
            $data['modelData'] = $this->editData();
        }

        if(in_array('all',$types)){
            $data = [
                'mainData' => $this->mainData(),
                'searchData' => $this->searchData(),
                'tableData' => $this->tableData(),
                'modelData' => $this->addData(),
            ];
        }
        return $data;
    }
}
