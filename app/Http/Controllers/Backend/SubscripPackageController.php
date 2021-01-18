<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\SubscripPackage;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class SubscripPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.sub-packages.index');
    }

    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $subPackages = "";


      
        $subPackages = SubscripPackage::query()->orderBy('created_at', 'desc');

        if (auth()->user()->isAdmin()) {
            $has_view = true;
            $has_edit = true;
            $has_delete = true;
        }


        return DataTables::of($subPackages)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.subPackages', 'label' => 'id', 'value' => $q->id]);
                }

                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.subPackages.show', ['subPackage' => $q->id])])->render();
                }

                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.subPackages.edit', ['subPackage' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.subPackages.destroy', ['subPackage' => $q->id])])
                        ->render();
                    $view .= $delete;
                }


                return $view;
            })
            ->rawColumns(['actions', 'image'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sub-packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (!Gate::allows('SubPackage_create')) {
        //     return abort(401);
        // }

        $request->all();
       

        $slug = "";
        if (($request->slug == "") || $request->slug == null) {
            $slug = str_slug($request->title);
        } elseif ($request->slug != null) {
            $slug = $request->slug;
        }

        $slug_lesson = SubscripPackage::where('slug', '=', $slug)->first();
        if ($slug_lesson != null) {
            return back()->withFlashDanger(__('alerts.backend.general.slug_exist'));
        }


        $SubPackage = SubscripPackage::create($request->all());
        $SubPackage->slug = $slug;
        $SubPackage->save();

      
        return redirect()->route('admin.subPackages.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscripPackage  $subscripPackage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subPackage = SubscripPackage::findOrFail($id);
        return view('backend.sub-packages.show', compact('subPackage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscripPackage  $subscripPackage
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $subPackage = SubscripPackage::findOrFail($id);
       
        return view('backend.sub-packages.edit', compact('subPackage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscripPackage  $subscripPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $SubPackage = SubscripPackage::findOrFail($id);

        $slug = "";
        if (($request->slug == "") || $request->slug == null) {
            $slug = str_slug($request->title);
        } elseif ($request->slug != null) {
            $slug = $request->slug;
        }

        $slug_lesson = SubscripPackage::where('slug', '=', $slug)->where('id', '!=', $id)->first();
        if ($slug_lesson != null) {
            return back()->withFlashDanger(__('alerts.backend.general.slug_exist'));
        }


        $SubPackage->update($request->all());

        $SubPackage->slug = $slug;
        $SubPackage->save();
        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscripPackage  $subscripPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SubPackage = SubscripPackage::findOrFail($id);

       
            $SubPackage->delete();
      

        return redirect()->route('admin.subPackages.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
