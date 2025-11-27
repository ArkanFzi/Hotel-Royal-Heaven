# TODO: Fix Member Pemesanan Controller Routing Issues

## Pending Tasks
- [x] Update routes/web.php to use Member\PemesananController for member pemesanan routes
- [x] Rename index() to myBookings() in Member\PemesananController
- [x] Add cancelBooking() method to Member\PemesananController
- [x] Add $reviewedKamarIds variable to myBookings method
- [x] Update redirect in store() to use correct route name (member.pemesanan.my)
- [x] Add Review model import to Member\PemesananController

## Followup Steps
- [x] Test the member pemesanan functionality after changes
- [x] Fix additional "Route [member.index] not defined" error
