Read Me (README.txt)
---------------------------------------------------------

 * Version 6.x-2.x
 * Contact: Bryan Lewellen (bryrock) (http://drupal.org/user/346823)
 *

Summary of Key Features in this version:

 * Logs work!
 * Session and cached Whitelisting works! (grants user access after passing a simple test)
 * Thresholds for grey and blacklisting are configurable settings.
 * Messages to grey and blacklisted users are configurable.
 * Length of time cached visits are held are determined by configurable settings (not hard-coded values).
 * Default Views included (see blocked IPs with links to their Honeypot profiles)


WHY THIS VERSION IS A RECOMMENDED IMPROVEMENT
---------------------------------------------

The 6.x-2.x fork was created because the solution to a number of bugs in the original 6.x-1.x fork were for some time considered controversial, so they were not added to 6.x-1.x.  It was believed by some that sites with heavy traffic would find that logging the results of grey or blacklisting malicious traffic might be too processor "expensive" to be worth it.

However, before the 6.x-2.x fork was made publicly available it was production tested on about a dozen sites for nearly two years and found to be effective, without any noticeable downside.  Also, the 6.x-2.x fork has now been in use since July 2011 on Drupal.org.

As to whether or not anyone really needs this logging capability, some feel that they do.  It's the quickest way to get some insight into how often your site comes under "attack" from known, malicious IPs.  You might be surprised to see how often it occurs, even on sites with relatively low traffic.

Also, even though the unwanted traffic that httpbl stops is most often non-human, robotic traffic, it does occasionally block real people, as it should, when they have compromised IP addresses found in the Project Honeypot database of nuisance traffic.  Depending on the application environment, when real people are blocked, they or others (important users, site admins, managers, executives, etc.) may feel the pressing need to know and/or explain why.  The logs can assist in validating and revealing the evidence that the blocked IP was correctly and appropriately blocked.  It allows you to say, "They were blocked because they're bad traffic.  That's what you wanted, right?"

If you are still concerned about the possible "expense" of logging grey and blacklisted IPs, you can turn off logging.

The 6.x-2.x fork also adds a number of configurable options that were hard-coded in 6.x-1.x:

	- Grey-listing & Blacklisting thresholds are now configurable, so you can fine-tune them to only block higher levels of threat (or effectively turn it off altogether, if you choose).  For most site, however, the default values are recommended.
	- The messages seen by human-users who get grey or blacklisted are now customizable, if you'd like to add further explanation to them for your users.

A note about httpbl (D7)
--------------------------------------

When you're ready for httpbl (D7), thanks to improvements in Drupal's API for 7 and beyond, the issues that led to logging bugs in the original 6.x-1.x fork are no longer an operative factor.  In other words, httpbl 7x handles the needed logging quite well without the prospect of added "expense."

 
Bryrock
September 2011
