public function show(Kamar $kamar)
    {
        return view('member.kamar.show', compact('kamar'));
    }
=======
    // Show kamar list with reviews - only show available rooms
    public function index()
    {
        $kamar = Kamar::with(['tipe', 'reviews'])
            ->where('status_ketersediaan', 'available')
            ->get()
            ->map(function ($kamar) {
                $kamar->average_rating = $kamar->reviews->avg('rating') ?? 0;
                $kamar->review_count = $kamar->reviews->count();
                return $kamar;
            });

        // Get room types that have available rooms
        $tipeKamars = \App\Models\TipeKamar::whereHas('kamars', function ($query) {
            $query->where('status_ketersediaan', 'available');
        })->get();

        return view('member.kamar.index', compact('kamar', 'tipeKamars'));
    }

    // Show kamar detail
    public function show(Kamar $kamar)
    {
        $kamar->load(['tipe', 'reviews.user']);
        return view('member.kamar.show', compact('kamar'));
    }
