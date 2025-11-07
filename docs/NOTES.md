## Notes

#### For the post view counting feature, if the site had high traffic, we could store the IPs and the corresponding posts that need a view increment in Redis, and then read them every 5 minutes to update the views and total_post_views fields in batch.

#### Additionally, we could have used HyperLogLog for more efficient unique counting, but due to time constraints, I opted for a simpler approach.

---
