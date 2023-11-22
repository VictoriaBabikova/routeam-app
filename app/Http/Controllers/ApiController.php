<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\SearchData;
use Illuminate\Http\Request;

class ApiController extends Controller
{    
    /**
     * SearchProgect
     *
     * @param  mixed $request
     * @param  mixed $service
     * @return void
     */
    public function SearchProgect(Request $request, SearchData $service)
    {
        $project = Project::SubjectSearch($request->subject)->get();
        if (empty($project->toArray())) {
            $project_list = $service->getDataFromApiGithub($request->subject);
            $data = [
                'subject' => $request->subject,
                'proj_info' => $project_list
            ];
            if (isset($project_list)) {
                $project = new Project;
                $project->subject = trim($request->subject);
                $project->proj_info = trim($project_list);
                $project->save();
            }
        }
        return redirect()->route('api_projects_show',['subject' => $project[0]->subject]);

    }    
    /**
     * ShowProjectsList
     *
     * @param  mixed $request
     * @return void
     */
    public function ShowProjectsList(Request $request)
    {
        $project = Project::SubjectSearch($request->subject)->get();
        $proj_arr = json_decode($project[0]['proj_info'], true);
        $array_projects = [];
        for ($i=0; $i < count($proj_arr['items']); $i++) { 
            $array_projects[$i] = [
                'name_project' => $proj_arr['items'][$i]['name'],
                'author' => $proj_arr['items'][$i]['owner']['login'],
                'stargazers_count' => $proj_arr['items'][$i]['stargazers_count'],
                'watchers_count' => $proj_arr['items'][$i]['watchers_count'],
                'svn_url' => $proj_arr['items'][$i]['svn_url'],
            ]; 
        }

        return json_encode(['subject' => $project[0]['subject'], 'projects' => $array_projects]);
    }
    
    /**
     * DeleteProgect
     *
     * @param  mixed $id
     * @return void
     */
    public function DeleteProgect(int $id)
    {
        $product = Project::find($id);
        $product->delete();
        return "success";
    }
    
}
