<?php
use PaperClip\Support\Contracts\PaperClipDashboardModelManagementController;
use Illuminate\Laravel\Validator\Validator as Validator;

class DashboardCandyController extends PaperClipDashboardModelManagementController {
  protected $domain = 'admin.dashboard';

  public function index()
  {
    return $this->setupLayout();
  }

    /**
     * Store a newly created resource in storage.
     * POST /dashboardlanguage
     *
     * @return Response
     */
    public function store()
    {   
      $input = array('name', 'url');
      $restoreTriggers = array('url');
      return $this->storeStub($input, $restoreTriggers);
    }

    /**
     * Display the specified resource.
     * GET /dashboardlanguage/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /dashboardlanguage/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      return $this->editStub($id, array(
        'name',
        'url',));
    }

    /**
     * Update the specified resource in storage.
     * PUT /dashboardlanguage/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

      $inputs = array(
        'name', 
        'url');
      $restoreTriggers = array('url');
      $unique = array('url');

      return $this->updateStub($id, $inputs, $restoreTriggers, $unique);
    }

    /**
     * Retores an soft-deleted item.
     * @param  numeric $id
     * @return Response
     */ 
    public function restore($id)
    {
      return $this->restoreStub($id);
    }
    /**
     * Remove the specified resource from storage.
     * DELETE /dashboardlanguage/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      return $this->destroyStub($id);
    }

    public function upload() 
    {
      $uploads = public_path('/uploads');
      $fileField = Input::file('file');
      if($fileField && $fileField->isValid())
      {
        // Inspect type and size
        $check = \Validator::make(
          array(
            'file' => $fileField
            ), 
          array(
            'file' => 'min:1|image'
            ),
          array(
            'min' =>  Lang::trans('validation.min.file', array(1)),
            'image' => Lang::trans('validation.image', array('file'))
            ));
        if($check->fails()) {
          return Response::json(implode('<br>', $check->messages()), 500);
        }

        $path = Input::file('file')->move($uploads)->getRealPath();
        $filename = Input::file('file')->getClientOriginalName();
        
        $file = explode(DIRECTORY_SEPARATOR, $path);
        array_pop($file);
        array_push($file, $filename);
        $file = implode('/', $file);
        
        if(file_exists($file)) {
          unlink($path);
          return Response::json(trans('validation.duplicate-name', array('entity' => trans('adminItems.file'))), 500);
        }

        // Propername the files, e.g. xxxx.tmp -> myName.png 
        rename($path, $file);

        // Add entry to the database
        \Blob::unguard();
        \Blob::create(array(
          'name' => $filename,
          'url' => \URL::to('/') . '/uploads/' . $filename,
          'path' => $file,
          'size' => filesize($file)
          )
        );
        Blob::reguard();

        return Response::json('ok', '200');
      }
      return Response::json('fail', '500');
    }

    public function deleteUploadedFile($id, $silent = false)
    {
      if(is_numeric($id))
        $entry = \Blob::where('id', '=', $id)->first();
      else if(is_object($id))
        $entry = $id;

      if($entry)
      {
        try {
          $entry->forceDelete();
          unlink($entry->path);
          if($silent) return;
        } catch(Exception $e) {
          return Response::json('fail!' . $e, 500);
        }
        return Response::json('ok', 200);
      }
      return Response::json('fail', 404);
    }

    public function flushUploads()
    {
      $entries = \Blob::all();
      return $this->deleteManyFiles($entries);
    }

    protected function deleteManyFiles($entries)
    {
      foreach ($entries as $entry) 
      {
        try {
          $fail = $this->deleteUploadedFile($entry, true);
          if($fail) return $fail;
        } catch(Exception $e) {
          return Response::json('fail', 500);
        }
      }
      return Response::json('ok', 200);
    }

    public function deleteUploadsByOffset($start, $end)
    {
      $entries = \Blob::where('id', '>=', $start)->where('id', '<=', $end)->get();
      return $this->deleteManyFiles($entries);
    }

    public function deleteFileByName($name)
    {
      $entries = \Blob::where('name', '=', urldecode($name))->get();
      return $this->deleteManyFiles($entries);
    }

    public function fetchUploads($start, $amount)
    {
      $entries = \Blob::where('id', '>=', '0')->limit($amount)->offset($start-1)->get()->toArray();
      return Response::json(json_encode($entries), 200);
    }
  }