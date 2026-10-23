<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MatchaController extends Controller
{
    public function index()
    {
        $menuItems = [
            'usucha' => [
                'id' => 'usucha',
                'name' => 'Usucha (薄茶)',
                'subtitle' => 'Ceremonial Grade • First Harvest Tencha • Pure Spring Water',
                'description' => 'The authentic foundation of the Japanese tea ceremony. Whisked rigorously with a 100-prong bamboo chasen until a thick, micro-bubble crema carpets the bowl. Velvety, with sweet vegetal notes and pronounced natural umami, concluding with clean mineral crispness.',
                'price' => 30000,
                'image' => 'images/Usucha Display.jpeg',
                'badge' => '01 • Traditional Ritual',
                'serving' => '120ml Chawan',
                'prep' => '3 min',
                'tags' => ['Creamy Jade Froth', 'Oceanic Umami', 'Zero Sugar', 'Hot Only (78°C)'],
            ],
            'latte' => [
                'id' => 'latte',
                'name' => 'Classic Matcha Latte',
                'subtitle' => 'Uji Autumn & Spring Blend • Barista Oat / Dairy Milk • Organic Agave',
                'description' => 'Our bestselling daily ritual drink. A concentrated ceremonial matcha shot poured over silky micro-steamed milk of your choice. Robust enough to cut through milk sweetness while leaving a lingering floral and toasted nori bouquet.',
                'price' => 35000,
                'image' => 'images/Matcha latte.jpeg',
                'badge' => '02 • House Signature',
                'serving' => '350ml Glass',
                'prep' => '2 min',
                'tags' => ['Silky Microfoam', 'Custom Sweetness', 'Hot or Iced', 'Oat / Whole / Almond'],
            ],
            'coconut' => [
                'id' => 'coconut',
                'name' => 'Coconut Matcha (Cloud Refresher)',
                'subtitle' => 'Raw Young Nam Hom Coconut Water • Hand-Aerated Ceremonial Matcha Crema',
                'description' => 'Light, hydrating, and visually captivating. Clear young coconut water loaded with natural electrolytes is gently topped with a chilled emerald matcha cloud. Every sip offers pure natural coconut sweetness followed by grounding matcha complexity.',
                'price' => 35000,
                'image' => 'images/Coconut Matcha.jpeg',
                'badge' => '03 • Refreshing Infusion',
                'serving' => '400ml Highball',
                'prep' => '2 min',
                'tags' => ['Dual Layer Visual', 'Electrolyte Rich', 'Naturally Sweet', 'Served Over Ice'],
            ],
            'ube' => [
                'id' => 'ube',
                'name' => 'Ube Matcha (紫芋抹茶)',
                'subtitle' => 'Real Purple Yam Halaya Mash • Sweet Condensed Foam • Kyoto Ceremonial Matcha',
                'description' => 'An artisan combination of Filipino slow-cooked purple yam with Kyoto ceremonial matcha. The base features rich, silky ube halaya spread along the glass, poured over fresh chilled oat milk and capped with rich dark green whisked tea.',
                'price' => 45000,
                'image' => 'images/Matcha Ube.jpeg',
                'badge' => '04 • Modern Fusion',
                'serving' => '380ml Tumbler',
                'prep' => '3 min',
                'tags' => ['Decadent Purple Yam', 'Tricolor Aesthetic', 'Dessert in a Cup', 'Iced Only'],
            ],
        ];

        return view('matcha.index', compact('menuItems'));
    }

    // Store a new order
    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone'         => 'nullable|string|max:30',
            'dine_option'   => 'required|string',
            'notes'         => 'nullable|string|max:500',
            'items'         => 'required|array|min:1',
            'subtotal'      => 'required|numeric|min:0',
            'tax'           => 'required|numeric|min:0',
            'total_amount'  => 'required|numeric|min:0',
        ]);

        $nextNumber = Order::count() + 1;
        $orderId    = 'ORD-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $order = Order::create([
            'order_id'      => $orderId,
            'customer_name' => $validated['customer_name'],
            'phone'         => $validated['phone'] ?? 'Walk-in',
            'dine_option'   => $validated['dine_option'],
            'notes'         => $validated['notes'] ?? null,
            'items'         => $validated['items'],
            'subtotal'      => $validated['subtotal'],
            'tax'           => $validated['tax'],
            'total_amount'  => $validated['total_amount'],
            'status'        => 'PAID',
            'ordered_at'    => now(),
        ]);

        return response()->json([
            'success' => true,
            'order'   => $order,
        ]);
    }
}