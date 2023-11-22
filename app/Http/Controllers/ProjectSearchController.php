<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\SearchData;

class ProjectSearchController extends Controller
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
        } else {
            $data = [
                'subject' => $project[0]->subject,
                'proj_info' => $project[0]->proj_info
            ];
        }
        return redirect()->route('projects_show')->with(['data' => $data]);
    }
    
    /**
     * ShowProjectsList
     *
     * @return void
     */
    public function ShowProjectsList()
    {
        $data = session('data');
        $proj_arr = json_decode($data['proj_info'], true);
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

        return view('showProjectList', ['subject' => $data['subject'], 'projects' => $array_projects]);
    }
}
