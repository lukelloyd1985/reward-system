# Kids Reward System

Reward system for kids to incentivize them to be good and help with chores

## Usage

Download the latest release into a directory on your webserver.

Copy the `example-kids.json` to create a `kids.json` file.

Set options within the `kids.json` file to suit you.

Make sure your webserver can write to the `kids.json` file. Usually this means making the file owned by `www-data` for example.

## JSON file options

Options exist for each kid (k1 & k2) within the JSON file...

`name`: child name

`currency`: currency symbol to use for the child e.g. £ $ €

`image`: name of directory under "images" to use for rewards

`maxRewards`: max rewards to display before payout. For reward icons to show correctly on tablet screens is looks like "18" is a good value for 2x kids and "36" for 1x kid.

`pay`: amount to pay after max rewards

`rewards`: LEAVE - this is used to track rewards count

`cash`: LEAVE - this is used to track amount owed

## Contributions

If you find any issues or would like additional features then please open a GitHub issue providing as much detail as possible.

If you can code in PHP and would like to contribute then feel free to pick up a GitHub issue, create a branch and develop. Once complete open a PR request to merge into main branch.

## Acknowledgements

Thanks to [@hodcon](https://github.com/hodcon) for his code which was the basis for this