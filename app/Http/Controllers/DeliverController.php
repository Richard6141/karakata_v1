<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Deliver;
use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AvailableDeliver;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\DeliverRepositoryInterface;
use League\Container\Exception\NotFoundException;

class DeliverController extends Controller
{
    private DeliverRepositoryInterface $deliverRepository;
    private OrderRepositoryInterface $orderRepository;

    public function __construct(
        DeliverRepositoryInterface $deliverRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->deliverRepository = $deliverRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Undocumented function
     *
     * @return View
     */
    public function index()
    {
        return view('delivers.index', [
            'delivers' => $this->deliverRepository->getAllDelivers(),
        ]);
    }


    /**
     * Undocumented function
     *
     * @return View
     */

    public function add(): View
    {
        return view('delivers.add');
    }

    public function edit(string $id): View
    {
        if (!blank(htmlspecialchars(trim($id)))) {
            $delivers = $this->deliverRepository->getdeliverById($id);
            return view('delivers.edit', [
                'delivers' => $delivers,
            ]);
        } else {
            \abort(403);
        }
    }

    /**
     * Undocumented function
     *
     * @return View
     */
    public function finished()
    {
        $delivers = $this->deliverRepository->getAllAvailableDeliver();
        $orders = $this->deliverRepository->getTodayUnfinishedOrder();
        return view('delivers.unfinished', [
            'delivers' => $delivers,
            'orders' => $orders,
        ]);
    }

    /**
     * Undocumented function
     *
     * @return View
     */

    public function assignOrders()
    {
        $delivers = $this->deliverRepository->getAllAvailableDeliver();

        //Entreprise commande d'aujourd'hui non assignée, non livrée,
        $orders = $this->deliverRepository->getTodayOrderNotDelivered();
        // dd($orders);
        return view('delivers.assign', [
            'delivers' => $delivers,
            'orders' => $orders,
        ]);
    }

    /**
     * Undocumented function
     *
     * @return View
     */

    public function desassignOrders(Deliver $deliver)
    {
        if (!$deliver instanceof Deliver) {
            throw new NotFoundException('Error Processing Request', 1);
        }

        $orders = $this->deliverRepository->getAllOrderAssignedNotDelivered(
            $deliver->id
        );
    // dd($orders);
        // dd($deliver);

        return view('delivers.desassign', [
            'delivers' => $deliver,
            'orders' => $orders,
            'name' => $deliver,
        ]);
    }

    /**
     * Undocumented function
     *
     * @return View
     */

    public function delivery(Deliver $deliver)
    {
        if (!$deliver instanceof Deliver) {
            throw new NotFoundException('Error Processing Request', 1);
            // \abort(404);
        }
        $orders = $this->deliverRepository->getAllOrderAssignedNotDelivered(
            $deliver->id
        );
        return view('delivers.delivery', [
            'orders' => $orders,
            'delivers' => $deliver,
        ]);
    }

    /**
     * Undocumented function
     *
     * @return View
     */

    public function deliveryRecover(Deliver $deliver)
    {
        if (!$deliver instanceof Deliver) {
            throw new NotFoundException('Error Processing Request', 1);
            // \abort(404);
        }
        $orders = $this->deliverRepository->getAllOrderAssignedDelivered(
            $deliver->id
        );
        return view('delivers.deliveryrecover', [
            'delivers' => $deliver,
            'orders' => $orders,
        ]);
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse
     */

    public function store(Request $request)
    {
        if ($request->email) {
            $request->validate([
                'email' => 'email',
            ]);
        }
        $request->validate([
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'phone' => 'required|min:8|max:15',
        ]);
        try {
            $newDeliver = [
                'id' => Str::uuid(),
                'email' => htmlspecialchars(strval($request->email)),
                'lastname' => strtoupper(
                    htmlspecialchars(trim(strval($request->lastname)))
                ),
                'firstname' => ucfirst(htmlspecialchars(trim(strval($request->firstname)))),
                'phone' => htmlspecialchars(strval($request->phone)),
            ];
            Deliver::create($newDeliver);

            $message = 'Livreur enregistré !';
            return redirect()
                ->route('delivers.index')
                ->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur !";

            return redirect()
                ->route('delivers.index')
                ->with('error', "$message");
        }
    }

    public function updateDelivers(
        Request $request,
        Deliver $deliver
    ): RedirectResponse {
        try {
            if ($request->email) {
                $request->validate([
                    'email' => 'email',
                ]);
            }
            $request->validate([
                'lastname' => 'required|string',
                'firstname' => 'required|string',
                'phone' => 'required|min:8|max:15',
            ]);

            $deliverDetails = $request->only([
                'lastname',
                'email',
                'firstname',
                'phone',
            ]);
            $this->deliverRepository->updateDeliver(
                $deliver->id,
                $deliverDetails
            );
            $message = 'Livreur modifié !';
            return redirect()
                ->route('delivers.index')
                ->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administration !";
            return redirect()
                ->route('delivers.index')
                ->with('error', "$message");
        }
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse
     */

    public function destroyDeliver(Deliver $deliver)
    {
        try {
            if (!$deliver instanceof Deliver) {
                throw new NotFoundException('Error Processing Request', 1);
                // \abort(404);
            }
            $commande = $this->orderRepository->deliverOnce($deliver->id);
            $availableDeliver = $this->deliverRepository->getAvailableDeleverById(
                $deliver->id
            );
            if (
                $commande instanceof Order ||
                $availableDeliver instanceof AvailableDeliver
            ) {
                $message = 'Impossible de supprimé ce livreur!';
                return redirect()
                    ->route('delivers.index')
                    ->with('error', "$message");
            }
            $this->deliverRepository->deleteDeliver($deliver->id);
    
            $message = 'Livreur supprimée !';
            return redirect()
                ->route('delivers.index')
                ->with('success', "$message");
            } catch (\Throwable $th) {
                $message = "Erreur, veuillez contacter l'administration !";
                return redirect()
                    ->route('delivers.index')
                    ->with('error', "$message");
            }
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse
     */

    public function assignOrder(Request $request)
    {
        // $request->validate([
        //     'deliver_id' => ['required', 'string'],
        //     'commande' => ['required', 'array'],
        // ]);
        // dd($request->deliver_id);
        if (is_null($request->deliver_id)) {
            return back()->with('error', 'Veuillez sélectionner un livreur');
        }
        $deliver_id = htmlspecialchars(trim(strval($request->deliver_id)));

        $user_id = htmlspecialchars(trim(strval(Auth::user()->id ?? null)));
        $deliver = Deliver::where('id', $deliver_id)->exists();
        if ($deliver == false || blank($request->commande)) {
            return back()->with('error', 'Une erreur est subvenue !');
        }
        $orderDetails = [
            'deliver_id' => $deliver_id,
            'updated_by' => $user_id,
        ];
        /** @var array $data*/
        $data = $request->commande;

        foreach ($data as $command) {
            $commande = $this->orderRepository->getOrderById($command);
            if ($commande instanceof Order) {
                $this->orderRepository->updateOrder($command, $orderDetails);
            }
        }
        $message = 'Livraison  attribuée !';
        return back()->with('success', "$message");
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse
     */

    public function desassignOrder(Request $request)
    {
        $request->validate([
            'commande' => ['required', 'array'],
            'deliver_id' => ['required', 'string'],
        ]);

        $deliver_id = htmlspecialchars(trim(strval($request->deliver_id)));
        $user_id = htmlspecialchars(trim(strval(Auth::user()->id ?? null)));
        $deliver = Deliver::where('id', $deliver_id)->exists();
        if ($deliver == false || blank($request->commande)) {
            return back()->with('error', 'Une erreur est subvenue !');
        }
        $orderDetails = [
            'deliver_id' => null,
            'updated_by' => $user_id,
        ];

        try {
            $data = $request->commande;
            /** @var array $data*/

            foreach ($data as $command) {
                $commande = $this->orderRepository->getOrderById($command);
                if (!$commande instanceof Order) {
                    throw new NotFoundException('Error Processing Request', 1);
                    // \abort(404);
                }
                $this->orderRepository->updateOrder(
                    $command,
                    $orderDetails
                );
            }
            $message = 'Livraison  désassignée !';
            return back()->with('success', "$message");
        } catch (\Throwable $th) {
            $message = 'Une erreur est subvenue !';
            return back()->with('error', "$message");
        }
    }

    public function manageDeliveryStatusTrue(
        Request $request,
        Deliver $deliver
    ): RedirectResponse {
        $request->validate([
            'commande' => ['required', 'array'],
        ]);
        $orderDetails = [
            'status_delivery' => true,
            'delivery_time' => date('H:i:s'),
            'updated_by' => htmlspecialchars(trim(strval(Auth::user()->id ?? null))),
        ];


        try {
            $data = $request->commande;
            /** @var array $data*/

            foreach ($data as $command) {
                $commande = $this->orderRepository->getOrderById($command);
                if (!$commande instanceof Order) {
                    throw new NotFoundException('Error Processing Request', 1);
                    // \abort(404);
                }
                $this->orderRepository->updateOrder(
                    $command,
                    $orderDetails
                );
            }
            $message = 'Livraison  effectuée !';
            return back()->with('success', "$message");
        } catch (\Throwable $th) {
            $message = 'Une erreur est subvenue !';
            return back()->with('error', "$message");
        }
    }
    /**
     * Undocumented function
     *
     * @return RedirectResponse
     */

    public function manageDeliveryStatusFalse(
        Request $request,
        Deliver $deliver
    ) {
        $request->validate([
            'commande' => ['required', 'array'],
        ]);
        $orderDetails = [
            'status_delivery' => false,
            'delivery_time' => null,
            'updated_by' => htmlspecialchars(trim(strval(Auth::user()->id ?? null))),
        ];
        // dd($orderDetails);

        try {
            $data = $request->commande;
            /** @var array $data*/

            foreach ($data as $command) {
                $commande = $this->orderRepository->getOrderById($command);
                if (!$commande instanceof Order) {
                    // throw new NotFoundException('Error Processing Request', 1);
                    abort(404);
                }
                $this->orderRepository->updateOrder(
                    $command,
                    $orderDetails
                );
            }
            $message = 'Livraison retirée !';
            return back()->with('success', "$message");
        } catch (\Throwable $th) {
            $message = 'Une erreur est subvenue !';
            return back()->with('error', "$message");
        }
    }

    // public function listdeliver_order(string $id)
    // {
    //     $date = date('Y-m-d');
    //     $deliver = Order::where('deliver_id', '!=', null)
    //         ->where('date', $date)
    //         ->get();
    // }

    /**
     * Undocumented function
     *
     * @return View
     */

    public function listDeliversAvailable()
    {
        // $date = date('Y-m-d');
        // $delivers = Deliver::all();
        // $delivers = DB::table('available_delivers As A')
        //     ->join('delivers As B', 'A.deliver_id', 'B.id')
        //     ->where('A.end_day', '<', $date)
        //     ->select('B.*')
        //     ->get();

        // $delivers = DB::table('delivers As A')
        //     ->join('available_delivers As B', 'A.id', 'B.deliver_id')
        //     ->where('B.end_day', '<', $date)
        //     ->select('A.*')
        //     ->get();
        $delivers = $this->deliverRepository->getAllDelivers();
        return view('delivers.available_delivers', [
            'delivers' => $delivers,
        ]);
    }

    /**
     * Undocumented function
     *
     * @return View
     */

    public function show(Deliver $deliver)
    {
        if (!$deliver instanceof Deliver) {
            throw new NotFoundException('Error Processing Request', 1);
            // \abort(404);
            //Entreprise commande d'aujourd'hui assignée, non livrée
        }
        $allorders = $this->deliverRepository->getOrdersByCustomerId($deliver->id);
        // dd($allorders);
        $number = $this->deliverRepository->getOrdersByCustomerIdNumber($deliver->id);
        // dd($number);
        return view('delivers.deliver_profil', [
            'deliver' => $deliver,
            'number' => count($number),
            'allorders' => $allorders,
            'orders' => $this->deliverRepository->deliverOrderDeliveredCount(
                $deliver->id
            ),
        ]);
    }
}
