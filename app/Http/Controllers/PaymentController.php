<?php

namespace App\Http\Controllers;

use App\Repository\PaymentRepository;
use App\Repository\ProjectRepository;
use App\Models\Payment;
use App\Http\Requests\PaymentRequest;


use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $paymentRepository;
    private $projectRepository;

     public function __construct(PaymentRepository $paymentRepository, ProjectRepository $projectRepository){
        $this->paymentRepository = $paymentRepository;
        $this->projectRepository = $projectRepository;

     }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $payments = $this->paymentRepository->getByProjectId($request->project_id, 'search');
        } else {
            $payments = $this->paymentRepository->all();

        }
        $projects = $this->projectRepository->all();
        return view('project.payment.index',compact('payments', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects= $this->projectRepository->all();
       return view('project.payment.add',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        try {
            $paymentDetails = $request->payment;
            $user_group= auth()->user()->user_group_id;
            if($user_group==2){
              $paymentDetails['project_id']=auth()->user()->project_id;
            }
            $create = Payment::create($paymentDetails);
            if ($create) {
                session()->flash('success', 'Payment successfully created!');
                return redirect(route('payment.index'));
            } else {
                session()->flash('error', 'Payment could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Exception' . $e->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = (int)$id;
            $edits['payment'] = $this->paymentRepository->findById($id);
            if ($edits['payment'] != null && $edits['payment']->count() > 0) {
                $projects = $this->projectRepository->all();
                return view('project.payment.edit', compact('edits', 'projects'));
            } else {
                session()->flash('error', 'Id could not be obtained!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $paymentDetails = $request->payment;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $paymentDetails['project_id'] = auth()->user()->project_id;
            }
            $payments = $this->paymentRepository->findById($id);
            if ($payments) {
                $payments->fill($paymentDetails)->save();
                session()->flash('success', 'Payment updated successfully!');

                return redirect(route('payment.index'));
            } else {

                session()->flash('error', 'No record with given id!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $value = $this->paymentRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Payment  successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
