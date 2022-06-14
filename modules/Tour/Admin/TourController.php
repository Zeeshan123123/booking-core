<?php
namespace Modules\Tour\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Models\Attributes;
use Modules\Location\Models\LocationCategory;
use Modules\Tour\Models\TourTerm;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;
use Modules\Tour\Models\TourTranslation;
use Modules\Tour\Models\TourPrice;
use Modules\Location\Models\Location;

class TourController extends AdminController
{
    protected $tourClass;
    protected $tourTranslationClass;
    protected $tourCategoryClass;
    protected $tourTermClass;
    protected $tourPriceModel;
    protected $attributesClass;
    protected $locationClass;
    /**
     * @var string
     */
    private $locationCategoryClass;

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('tour.admin.index'));
        $this->tourClass = Tour::class;
        $this->tourTranslationClass = TourTranslation::class;
        $this->tourCategoryClass = TourCategory::class;
        $this->tourTermClass = TourTerm::class;
        $this->tourPriceModel = TourPrice::class;
        $this->attributesClass = Attributes::class;
        $this->locationClass = Location::class;
        $this->locationCategoryClass = LocationCategory::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('tour_view');
        $query = $this->tourClass::query();
        $query->orderBy('id', 'desc');
        if (!empty($tour_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $tour_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if (!empty($is_featured = $request->input('is_featured'))) {
            $query->where('is_featured', 1);
        }
        if (!empty($location_id = $request->query('location_id'))) {
            $query->where('location_id', $location_id);
        }
        if ($this->hasPermission('tour_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'               => $query->with([
                'getAuthor',
                'category_tour'
            ])->paginate(20),
            'tour_categories'    => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_manage_others' => $this->hasPermission('tour_manage_others'),
            'page_title'         => __("Tour Management"),
            'breadcrumbs'        => [
                [
                    'name' => __('Tours'),
                    'url'  => route('tour.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('tour_view');
        $query = $this->tourClass::onlyTrashed();
        $query->orderBy('id', 'desc');
        if (!empty($tour_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $tour_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if ($this->hasPermission('tour_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'               => $query->with([
                'getAuthor',
                'category_tour'
            ])->paginate(20),
            'tour_categories'    => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_manage_others' => $this->hasPermission('tour_manage_others'),
            'page_title'         => __("Recovery Tour Management"),
            'recovery'           => 1,
            'breadcrumbs'        => [
                [
                    'name' => __('Tours'),
                    'url'  => route('tour.admin.index')
                ],
                [
                    'name'  => __('Recovery'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('tour_create');
        $row = new Tour();
        $row->fill([
            'status' => 'publish'
        ]);
        $data = [
            'row'               => $row,
            'attributes'        => $this->attributesClass::where('service', 'tour')->get(),
            'tour_category'     => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'translation'       => new $this->tourTranslationClass(),
            'breadcrumbs'       => [
                [
                    'name' => __('Tours'),
                    'url'  => route('tour.admin.index')
                ],
                [
                    'name'  => __('Add Tour'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('tour_update');
        $row = $this->tourClass::find($id);
        if (empty($row)) {
            return redirect(route('tour.admin.index'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        if (!$this->hasPermission('tour_manage_others')) {
            if ($row->create_user != Auth::id()) {
                return redirect(route('tour.admin.index'));
            }
        }
        $data = [
            'row'               => $row,
            'translation'       => $translation,
            "selected_terms"    => $row->tour_term->pluck('term_id'),
            'attributes'        => $this->attributesClass::where('service', 'tour')->get(),
            'tour_category'     => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Tours'),
                    'url'  => route('tour.admin.index')
                ],
                [
                    'name'  => __('Edit Tour'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.detail', $data);
    }

    public function store(Request $request, $id)
    {

        if ($id > 0) {
            $this->checkPermission('tour_update');
            $row = $this->tourClass::find($id);
            if (empty($row)) {
                return redirect(route('tour.admin.index'));
            }
            if ($row->create_user != Auth::id() and !$this->hasPermission('tour_manage_others')) {
                return redirect(route('tour.admin.index'));
            }
        } else {
            $this->checkPermission('tour_create');
            $row = new $this->tourClass();
            $row->status = "publish";
        }
        $row->fill($request->input());
        if ($request->input('slug')) {
            $row->slug = $request->input('slug');
        }
        $row->ical_import_url = $request->ical_import_url;
        $row->create_user = $request->input('create_user');
        $row->default_state = $request->input('default_state', 1);
        $row->enable_service_fee = $request->input('enable_service_fee');
        $row->service_fee = $request->input('service_fee');
        $res = $row->saveOriginOrTranslation($request->input('lang'), true);
        if ($res) {
            if (!$request->input('lang') or is_default_lang($request->input('lang'))) {
                $this->saveTerms($row, $request);
                $row->saveMeta($request);
            }
            if ($id > 0) {
                event(new UpdatedServiceEvent($row));
                return back()->with('success', __('Tour updated'));
            } else {
                event(new CreatedServicesEvent($row));
                return redirect(route('tour.admin.edit', $row->id))->with('success', __('Tour created'));
            }
        }
    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            $this->tourTermClass::where('tour_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->tourTermClass::firstOrCreate([
                    'term_id' => $term_id,
                    'tour_id' => $row->id
                ]);
            }
            $this->tourTermClass::where('tour_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->tourClass::where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->delete();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "permanently_delete":
                foreach ($ids as $id) {
                    $query = $this->tourClass::where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_delete');
                    }
                    $row = $query->withTrashed()->first();
                    if ($row) {
                        $row->forceDelete();
                    }
                }
                return redirect()->back()->with('success', __('Permanently delete success!'));
                break;
            case "recovery":
                foreach ($ids as $id) {
                    $query = $this->tourClass::withTrashed()->where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->restore();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Recovery success!'));
                break;
            case "clone":
                $this->checkPermission('tour_create');
                foreach ($ids as $id) {
                    (new $this->tourClass())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->tourClass::where("id", $id);
                    if (!$this->hasPermission('tour_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('tour_update');
                    }
                    $row = $query->first();
                    $row->status = $action;
                    $row->save();
                    event(new UpdatedServiceEvent($row));
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');
        if ($pre_selected && $selected) {
            if (is_array($selected)) {
                $items = $this->tourClass::select('id', 'title as text')->whereIn('id', $selected)->take(50)->get();
                return $this->sendSuccess([
                    'items' => $items
                ]);
            } else {
                $item = $this->tourClass::find($selected);
            }
            if (empty($item)) {
                return $this->sendSuccess([
                    'text' => ''
                ]);
            } else {
                return $this->sendSuccess([
                    'text' => $item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->tourClass::select('id', 'title as text')->where("status", "publish");
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return $this->sendSuccess([
            'results' => $res
        ]);
    }


    public function prices(Request $request)
    {
        $this->checkPermission('car_view');
        $query = $this->tourPriceModel::orderBy('ranges', 'asc');
        // $query->orderBy('id', 'desc');

        if (!empty($s = $request->input('s'))) {
            $query->where('ranges', 'LIKE', '%' . $s . '%')
                  ->orWhere('distance_from', 'LIKE', '%' . $s . '%')
                  ->orWhere('distance_to', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_1_price', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_1_add', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_1_discount', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_2_price', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_2_add', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_2_discount', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_3_price', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_3_add', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_3_discount', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_4_price', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_4_add', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_4_discount', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_5_price', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_5_add', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_5_discount', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_6_price', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_6_add', 'LIKE', '%' . $s . '%')
                  ->orWhere('range_6_discount', 'LIKE', '%' . $s . '%');
        }
        
        if ($this->hasPermission('car_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'              => $query->paginate(20),
            'car_manage_others' => $this->hasPermission('car_manage_others'),
            'recovery'          => 1,
            'breadcrumbs'       => [
                [
                    'name' => __('Tours'),
                    'url'  => route('tour.admin.index')
                ],
                [
                    'name'  => __('Tours Prices'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Tours Prices Management")
        ];
        
        return view('Tour::admin.prices.index', $data);
    }


    public function createPrices(Request $request)
    {
        $this->checkPermission('tour_create');
        $row = new Tour();
        $data = [
            'row'          => $row,
            'attributes'        => $this->attributesClass::where('service', 'tour')->get(),
            'tour_category'     => $this->tourCategoryClass::where('status', 'publish')->get()->toTree(),
            'tour_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'translation'       => new $this->tourTranslationClass(),
            'breadcrumbs'  => [
                [
                    'name' => __('Tour Prices'),
                    'url'  => route('tour.admin.prices')
                ],
                [
                    'name'  => __('Add Prices'),
                    'class' => 'active'
                ],
            ],
            'page_title'   => __("Add new Prices")
        ];
        return view('Tour::admin.prices.detail', $data);
    }


    public function editPrices(Request $request, $id)
    {
        
        $this->checkPermission('car_update');
        $row = $this->tourPriceModel::find($id);
        if (empty($row)) {
            return redirect(route('tour.admin.prices'));
        }
        
        $data = [
            'row'               => $row,
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Tour Prices'),
                    'url'  => route('tour.admin.prices')
                ],
                [
                    'name'  => __('Edit Prices'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Edit Prices")
        ];
        return view('Tour::admin.prices.detail', $data);
    }



    public function storePrices(Request $request, $id)
    {
        if ($id > 0) {
            $this->checkPermission('tour_update');
            $row = $this->tourPriceModel::find($id);
            if (empty($row)) {
                return redirect(route('car.admin.prices'));
            }
        } 
        
        if ($id > 0) {

            $row->ranges   = $request->input('ranges') ?? 0;
            $row->distance_from   = $request->input('distance_from') ?? 0;
            $row->distance_to = $request->input('distance_to') ?? 0;
            $row->range_1_price = $request->input('range_1_price') ?? 0;
            $row->range_1_add = $request->input('range_1_add') ?? 0;
            $row->range_1_discount = $request->input('range_1_discount') ?? 0;
            $row->range_2_price = $request->input('range_2_price') ?? 0;
            $row->range_2_add = $request->input('range_2_add') ?? 0;
            $row->range_2_discount = $request->input('range_2_discount') ?? 0;
            $row->range_3_price = $request->input('range_3_price') ?? 0;
            $row->range_3_add = $request->input('range_3_add') ?? 0;
            $row->range_3_discount = $request->input('range_3_discount') ?? 0;
            $row->range_4_price = $request->input('range_4_price') ?? 0;
            $row->range_4_add = $request->input('range_4_add') ?? 0;
            $row->range_4_discount = $request->input('range_4_discount') ?? 0;
            $row->range_5_price = $request->input('range_5_price') ?? 0;
            $row->range_5_add = $request->input('range_5_add') ?? 0;
            $row->range_5_discount = $request->input('range_5_discount') ?? 0;
            $row->range_6_price = $request->input('range_6_price') ?? 0;
            $row->range_6_add = $request->input('range_6_add') ?? 0;
            $row->range_6_discount = $request->input('range_6_discount') ?? 0;
            $row->updated_at = \Carbon\Carbon::now();
            
            $row->update();

            $row['title'] = 'Taxi Prices';
            event(new UpdatedServiceEvent($row));
            return back()->with('success', __('Prices updated'));
        } else {
            $row = $this->tourPriceModel::create([
                'ranges'   => $request->input('ranges') ?? 0,
                'distance_from'   => $request->input('distance_from') ?? 0,
                'distance_to' => $request->input('distance_to') ?? 0,
                'range_1_price' => $request->input('range_1_price') ?? 0,
                'range_1_add' => $request->input('range_1_add') ?? 0,
                'range_1_discount' => $request->input('range_1_discount') ?? 0,
                'range_2_price' => $request->input('range_2_price') ?? 0,
                'range_2_add' => $request->input('range_2_add') ?? 0,
                'range_2_discount' => $request->input('range_2_discount') ?? 0,
                'range_3_price' => $request->input('range_3_price') ?? 0,
                'range_3_add' => $request->input('range_3_add') ?? 0,
                'range_3_discount' => $request->input('range_3_discount') ?? 0,
                'range_4_price' => $request->input('range_4_price') ?? 0,
                'range_4_add' => $request->input('range_4_add') ?? 0,
                'range_4_discount' => $request->input('range_4_discount') ?? 0,
                'range_5_price' => $request->input('range_5_price') ?? 0,
                'range_5_add' => $request->input('range_5_add') ?? 0,
                'range_5_discount' => $request->input('range_5_discount') ?? 0,
                'range_6_price' => $request->input('range_6_price') ?? 0,
                'range_6_add' => $request->input('range_6_add') ?? 0,
                'range_6_discount' => $request->input('range_6_discount') ?? 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            $row['title'] = 'Tour Prices';
            event(new CreatedServicesEvent($row));
            return redirect(route('tour.admin.prices.edit', $row->id))->with('success', __('Prices created'));
        }
        
    }


    public function removePrices($id)
    {
        if ($id > 0) {
            $this->checkPermission('tour_update');
            $row = $this->tourPriceModel::find($id);

            if (!empty($row)) {
                $row->delete();

                $row['title'] = 'Tour Prices';
                
                // event(new CreatedServicesEvent($row));
                return redirect(route('tour.admin.prices', $row->id))->with('success', __('Prices deleted'));
            }
            else {
                return redirect(route('tour.admin.prices'))->with('success', __('Data not found!'));
            }
        } 
    }
}
