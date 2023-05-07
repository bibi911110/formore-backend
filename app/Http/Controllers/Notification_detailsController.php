<?php

namespace App\Http\Controllers;

use App\DataTables\Notification_detailsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNotification_detailsRequest;
use App\Http\Requests\UpdateNotification_detailsRequest;
use App\Repositories\Notification_detailsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Notification_detailsController extends AppBaseController
{
    /** @var  Notification_detailsRepository */
    private $notificationDetailsRepository;

    public function __construct(Notification_detailsRepository $notificationDetailsRepo)
    {
        $this->notificationDetailsRepository = $notificationDetailsRepo;

        $this->middleware('permission:notification_details-index|notification_details-create|notification_details-edit|notification_details-delete', ['only' => ['index','store']]);
        $this->middleware('permission:notification_details-create', ['only' => ['create','store']]);
        $this->middleware('permission:notification_details-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:notification_details-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Notification_details.
     *
     * @param Notification_detailsDataTable $notificationDetailsDataTable
     * @return Response
     */
    public function index(Notification_detailsDataTable $notificationDetailsDataTable)
    {
        return $notificationDetailsDataTable->render('notification_details.index');
    }

    /**
     * Show the form for creating a new Notification_details.
     *
     * @return Response
     */
    public function create()
    {
        return view('notification_details.create');
    }

    /**
     * Store a newly created Notification_details in storage.
     *
     * @param CreateNotification_detailsRequest $request
     *
     * @return Response
     */
    public function store(CreateNotification_detailsRequest $request)
    {
        $input = $request->all();

        $notificationDetails = $this->notificationDetailsRepository->create($input);

        Flash::success('Notification Details saved successfully.');

        return redirect(route('notificationDetails.index'));
    }

    /**
     * Display the specified Notification_details.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            Flash::error('Notification Details not found');

            return redirect(route('notificationDetails.index'));
        }

        return view('notification_details.show')->with('notificationDetails', $notificationDetails);
    }

    /**
     * Show the form for editing the specified Notification_details.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            Flash::error('Notification Details not found');

            return redirect(route('notificationDetails.index'));
        }

        return view('notification_details.edit')->with('notificationDetails', $notificationDetails);
    }

    /**
     * Update the specified Notification_details in storage.
     *
     * @param  int              $id
     * @param UpdateNotification_detailsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotification_detailsRequest $request)
    {
        $notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            Flash::error('Notification Details not found');

            return redirect(route('notificationDetails.index'));
        }

        $notificationDetails = $this->notificationDetailsRepository->update($request->all(), $id);

        Flash::success('Notification Details updated successfully.');

        return redirect(route('notificationDetails.index'));
    }

    /**
     * Remove the specified Notification_details from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            Flash::error('Notification Details not found');

            return redirect(route('notificationDetails.index'));
        }

        $this->notificationDetailsRepository->delete($id);

        Flash::success('Notification Details deleted successfully.');

        return redirect(route('notificationDetails.index'));
    }
}
