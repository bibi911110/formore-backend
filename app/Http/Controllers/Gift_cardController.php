<?php

namespace App\Http\Controllers;

use App\DataTables\Gift_cardDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateGift_cardRequest;
use App\Http\Requests\UpdateGift_cardRequest;
use App\Repositories\Gift_cardRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Gift_cardController extends AppBaseController
{
    /** @var  Gift_cardRepository */
    private $giftCardRepository;

    public function __construct(Gift_cardRepository $giftCardRepo)
    {
        $this->giftCardRepository = $giftCardRepo;

        $this->middleware('permission:gift_cards-index|gift_cards-create|gift_cards-edit|gift_cards-delete', ['only' => ['index','store']]);
        $this->middleware('permission:gift_cards-create', ['only' => ['create','store']]);
        $this->middleware('permission:gift_cards-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gift_cards-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Gift_card.
     *
     * @param Gift_cardDataTable $giftCardDataTable
     * @return Response
     */
    public function index(Gift_cardDataTable $giftCardDataTable)
    {
        return $giftCardDataTable->render('gift_cards.index');
    }

    /**
     * Show the form for creating a new Gift_card.
     *
     * @return Response
     */
    public function create()
    {
        return view('gift_cards.create');
    }

    /**
     * Store a newly created Gift_card in storage.
     *
     * @param CreateGift_cardRequest $request
     *
     * @return Response
     */
    public function store(CreateGift_cardRequest $request)
    {
        $input = $request->all();

        $giftCard = $this->giftCardRepository->create($input);

        Flash::success('Gift Card saved successfully.');

        return redirect(route('giftCards.index'));
    }

    /**
     * Display the specified Gift_card.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $giftCard = $this->giftCardRepository->find($id);

        if (empty($giftCard)) {
            Flash::error('Gift Card not found');

            return redirect(route('giftCards.index'));
        }

        return view('gift_cards.show')->with('giftCard', $giftCard);
    }

    /**
     * Show the form for editing the specified Gift_card.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $giftCard = $this->giftCardRepository->find($id);

        if (empty($giftCard)) {
            Flash::error('Gift Card not found');

            return redirect(route('giftCards.index'));
        }

        return view('gift_cards.edit')->with('giftCard', $giftCard);
    }

    /**
     * Update the specified Gift_card in storage.
     *
     * @param  int              $id
     * @param UpdateGift_cardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGift_cardRequest $request)
    {
        $giftCard = $this->giftCardRepository->find($id);

        if (empty($giftCard)) {
            Flash::error('Gift Card not found');

            return redirect(route('giftCards.index'));
        }

        $giftCard = $this->giftCardRepository->update($request->all(), $id);

        Flash::success('Gift Card updated successfully.');

        return redirect(route('giftCards.index'));
    }

    /**
     * Remove the specified Gift_card from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $giftCard = $this->giftCardRepository->find($id);

        if (empty($giftCard)) {
            Flash::error('Gift Card not found');

            return redirect(route('giftCards.index'));
        }

        $this->giftCardRepository->delete($id);

        Flash::success('Gift Card deleted successfully.');

        return redirect(route('giftCards.index'));
    }
}
