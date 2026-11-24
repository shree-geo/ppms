<?php
use App\Models\Projects;
use App\Models\ProjectStructures;
use App\Models\Samitis;
use App\Models\Structures;



function checkMemberStatus(){
    $user_group= auth()->user()->user_group_id;
    $samitiMember=[];   
   if($user_group==2){
        $project_id= auth()->user()->project_id;
        $projects=Projects::where('id',$project_id)->get();
        $members=Samitis::where('project_id',$project_id)->get();
        $membersByProject=$members->groupBy('project_id');
    }else if($user_group==3){
        $region_id=auth()->user()->region_id;
        $projects=Projects::where('region_id',$region_id)->get();
        $membersByProject=[];
        foreach($projects as $project){
             $data = Samitis::where('project_id', $project->id)->get();
                if (!$data->isEmpty()) {
                   $membersByProject[$project->id]= $data;
                }
        }

    }else{
        $projects= Projects::select('id','name')->get();
        $members=Samitis::all();
        $membersByProject=$members->groupBy('project_id');
    }
    foreach($projects as $project){
        if(isset($membersByProject[$project->id])){
            $countMem= $membersByProject[$project->id]->count();
            if($countMem>=9){
                $countFemale=Samitis::where('project_id',$project->id)->where('member_gender','female')->count();
               if($countFemale>=3){
                   $checkPosition= Samitis::where('project_id',$project->id)->whereBetween('position_id',[1,5])->where('member_gender','female')->get();
                if(count($checkPosition)>=1){
                    $samitiMember[$project->id]='Comply';

                }else{
                    $samitiMember[$project->id]='WUSC doesnot contain 1 female at key position';
                }

               }else{
                     $samitiMember[$project->id]='WUSC doesnot contain 3 female members';
               }

            }else{
                $samitiMember[$project->id]='WUSC doesnot contain 9 member';
            
            }
        }
        }
    return $samitiMember;
}


  
    function getMnu($parent_id = null)
    {
        if($parent_id){
            $menus = DB::table('menus')
            ->join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
            ->where('parent_id',$parent_id)
            ->where('allow_view', 1)
            ->where('menu_status', 1)
            ->where('user_group_id', Auth::user()->user_group_id)
            ->select('menus.*')
            ->get();
        } else{
            $menus =  DB::table('menus')
                ->join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
                ->where('parent_id',0)
                ->where('allow_view', 1)
                ->where('menu_status', 1)
                ->where('user_group_id', Auth::user()->user_group_id)
                ->select('menus.*')
                ->get();
            
        }
        foreach($menus as $parent){
            $parent->child=getMnu($parent->id);
        }
  
        return $menus;
    }


     function StructureParentList($sector){
        $result= Structures::where('parent_id',0)->where('sector_name',$sector)->orderBy('id','asc')->get();
        $parentColl=[];
        foreach($result as $data){
            $childs= getChild($data->id);
            if(count($childs)>0){
                $data['child']=$childs;
            }
            array_push($parentColl,$data);
        }
        return $parentColl;
    }

     function getChild($parent_id){
        $child= Structures::where('parent_id',$parent_id)->get();
        return $child;

    }
     function getByProjectId($proj_id)
    {
        $structures = ProjectStructures::where('project_id', $proj_id)->orderBy('id', 'asc')->get();
        $data= $structures->mapWithKeys(function($item){
            return [$item['structure_id']=>$item['estimation']];
        });
            return $data;
    }


?>

