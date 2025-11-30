# Real-time Room Data Update Fix

## Problem
After user books room > admin confirms > booking completed, room data doesn't appear/update in "daftar kamar" section.

## Root Cause
The MemberKamarController::index() method fetches ALL rooms without filtering by availability status, while the RoomFilter component properly filters for available rooms only.

## Solution Plan
1. Modify MemberKamarController::index() to filter rooms by status_ketersediaan = 'available'
2. Ensure room status is properly updated when bookings are confirmed/cancelled
3. Test the fix

## Files to Modify
- app/Http/Controllers/Member/KamarController.php (index method)
- app/Http/Controllers/Admin/PemesananController.php (updateStatus method - ensure room status is updated on confirmation)

## Testing Steps
1. Book a room as user
2. Confirm booking as admin
3. Check if room disappears from daftar kamar list
4. Cancel booking and verify room reappears
