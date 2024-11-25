<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Adeverisment;
use App\Traits\upload_file;
use Illuminate\Http\Request;

class AdeverismentController extends Controller
{
    use upload_file;
    function index()
    {
        // home banner one
        $homepage_secion_banner_one = Adeverisment::where('key', 'home_page_section_one')->first();
        if ($homepage_secion_banner_one) {
            $homepage_secion_banner_one = json_decode($homepage_secion_banner_one->value);
        }
        //home banner two
        $homepage_secion_banner_two = Adeverisment::where('key', 'home_page_section_two')->first();
        if ($homepage_secion_banner_two) {
            $homepage_secion_banner_two = json_decode($homepage_secion_banner_two->value);
        }
        //home banner three
        $homepage_secion_banner_three = Adeverisment::where('key', 'home_page_section_three')->first();
        if ($homepage_secion_banner_three) {
            $homepage_secion_banner_three = json_decode($homepage_secion_banner_three->value);
        }

        //product banner three
        $productpage_banner_section = Adeverisment::where('key', 'product_page_banner_section')->first();
        if ($productpage_banner_section) {
            $productpage_banner_section = json_decode($productpage_banner_section->value);
        }

          //Cart Page banner three
          $cartpage_banner_section = Adeverisment::where('key', 'cart_page_banners')->first();
          if ($cartpage_banner_section) {
              $cartpage_banner_section = json_decode($cartpage_banner_section->value);
          }
         // dd($productpage_banner_section);
        return view('admin.advertisement.index', compact('homepage_secion_banner_one', 'homepage_secion_banner_two', 'homepage_secion_banner_three','productpage_banner_section','cartpage_banner_section'));
    }

    public function UpdateBannerOne(Request $request)
    {
        $request->validate([
            'banner_image' => ['nullable', 'image'],
            'banner_url' => ['required'],
        ]);

        // Retrieve the existing advertisement by key
        $advertisement = Adeverisment::where('key', 'home_page_section_one')->first();

        // Decode the current value or initialize a new array if it doesn't exist
        $data = $advertisement ? json_decode($advertisement->value, true) : [];

        // Update only the banner_one data within the existing data
        $data['banner_one'] = [
            'banner_image' => $this->uploadFile($request, 'banner_image', $request->banner_old_image) ?: $request->banner_old_image,
            'banner_url' => $request->banner_url,
            'status' => $request->status == 'on' ? 1 : 0,
        ];

        // Save the updated data back as JSON
        Adeverisment::updateOrCreate(
            ['key' => 'home_page_section_one'],
            ['value' => json_encode($data)]
        );

        toastr('Data Updated Successfully', 'success');
        return redirect()->back();
    }

    public function UpdateBannerTwo(Request $request)
    {
        $request->validate([
            'banner_one_image' => ['nullable', 'image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['nullable', 'image'],
            'banner_two_url' => ['required'],
        ]);

        // Retrieve the existing advertisement by key
        $advertisement = Adeverisment::where('key', 'home_page_section_two')->first();

        // Decode the current value or initialize a new array if it doesn't exist
        $data = $advertisement ? json_decode($advertisement->value, true) : [];

        // Update banner_one data within the existing data
        $data['banner_one'] = [
            'banner_one_image' => $this->uploadFile($request, 'banner_one_image', $request->banner_one_old_image) ?: $request->banner_one_old_image,
            'banner_one_url' => $request->banner_one_url,
            'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0,
        ];

        // Update banner_two data within the existing data
        $data['banner_two'] = [
            'banner_two_image' => $this->uploadFile($request, 'banner_two_image', $request->banner_two_old_image) ?: $request->banner_two_old_image,
            'banner_two_url' => $request->banner_two_url,
            'banner_two_status' => $request->banner_two_status == 'on' ? 1 : 0,
        ];

        // Save the updated data back as JSON
        Adeverisment::updateOrCreate(
            ['key' => 'home_page_section_two'],
            ['value' => json_encode($data)]
        );

        toastr('Data Updated Successfully', 'success');
        return redirect()->back();
    }
    public function UpdateBannerThree(Request $request)
    {
        $request->validate([
            'banner_one_image' => ['nullable', 'image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['nullable', 'image'],
            'banner_two_url' => ['required'],
            'banner_three_image' => ['nullable', 'image'],
            'banner_three_url' => ['required'],
        ]);

        // Retrieve the existing advertisement by key
        $advertisement = Adeverisment::where('key', 'home_page_section_three')->first();

        // Decode the current value or initialize a new array if it doesn't exist
        $data = $advertisement ? json_decode($advertisement->value, true) : [];

        // Update banner_one data within the existing data
        $data['banner_one'] = [
            'banner_one_image' => $this->uploadFile($request, 'banner_one_image', $request->banner_one_old_image) ?: $request->banner_one_old_image,
            'banner_one_url' => $request->banner_one_url,
            'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0,
        ];

        // Update banner_two data within the existing data
        $data['banner_two'] = [
            'banner_two_image' => $this->uploadFile($request, 'banner_two_image', $request->banner_two_old_image) ?: $request->banner_two_old_image,
            'banner_two_url' => $request->banner_two_url,
            'banner_two_status' => $request->banner_two_status == 'on' ? 1 : 0,
        ];

        // Update banner_two data within the existing data
        $data['banner_three'] = [
            'banner_three_image' => $this->uploadFile($request, 'banner_three_image', $request->banner_three_old_image) ?: $request->banner_three_old_image,
            'banner_three_url' => $request->banner_three_url,
            'banner_three_status' => $request->banner_three_status == 'on' ? 1 : 0,
        ];

        // Save the updated data back as JSON
        Adeverisment::updateOrCreate(
            ['key' => 'home_page_section_three'],
            ['value' => json_encode($data)]
        );

        toastr('Data Updated Successfully', 'success');
        return redirect()->back();
    }

    public function UpdateProductBanner(Request $request)
    {
        $request->validate([
            'banner_image' => ['nullable', 'image'],
            'banner_url' => ['required'],
        ]);

        // Retrieve the existing advertisement by key
        $advertisement = Adeverisment::where('key', 'product_page_banner_section')->first();

        // Decode the current value or initialize a new array if it doesn't exist
        $data = $advertisement ? json_decode($advertisement->value, true) : [];

        // Update only the banner_one data within the existing data
        $data['product_banner'] = [
            'banner_image' => $this->uploadFile($request, 'banner_image', $request->banner_old_image) ?: $request->banner_old_image,
            'banner_url' => $request->banner_url,
            'status' => $request->status == 'on' ? 1 : 0,
        ];

        // Save the updated data back as JSON
        Adeverisment::updateOrCreate(
            ['key' => 'product_page_banner_section'],
            ['value' => json_encode($data)]
        );

        toastr('Data Updated Successfully', 'success');
        return redirect()->back();
    }

    public function UpdateCartBanner(Request $request)
    {
        $request->validate([
            'banner_one_image' => ['nullable', 'image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['nullable', 'image'],
            'banner_two_url' => ['required'],
        ]);

        // Retrieve the existing advertisement by key
        $advertisement = Adeverisment::where('key', 'cart_page_banners')->first();

        // Decode the current value or initialize a new array if it doesn't exist
        $data = $advertisement ? json_decode($advertisement->value, true) : [];

        // Update banner_one data within the existing data
        $data['banner_one'] = [
            'banner_image' => $this->uploadFile($request, 'banner_one_image', $request->banner_one_old_image) ?: $request->banner_one_old_image,
            'banner_url' => $request->banner_one_url,
            'status' => $request->banner_one_status == 'on' ? 1 : 0,
        ];

        // Update banner_two data within the existing data
        $data['banner_two'] = [
            'banner_image' => $this->uploadFile($request, 'banner_two_image', $request->banner_two_old_image) ?: $request->banner_two_old_image,
            'banner_url' => $request->banner_two_url,
            'status' => $request->banner_two_status == 'on' ? 1 : 0,
        ];

        // Save the updated data back as JSON
        Adeverisment::updateOrCreate(
            ['key' => 'cart_page_banners'],
            ['value' => json_encode($data)]
        );

        toastr('Data Updated Successfully', 'success');
        return redirect()->back();
    }
}
