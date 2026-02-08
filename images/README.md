# Reward Icons Guide

This directory contains reward icon sets used in the Kids Reward System.

## Current Reward Types (themed rewards)

- **rockets**
- **stars**
- **cars**
- **pawpatrol**
- **footballs**
- **unicorns**
- **rainbows**

## File Structure

Each reward type must have its own subdirectory containing exactly three files:

```
images/
├── reward-type-name/
│   ├── add.gif       # Animation shown when a reward is added
│   ├── remove.gif    # Animation shown when a reward is removed
│   └── icon.png      # Static icon displayed in the UI and progress bar
```

## File Requirements

### add.gif
- **Purpose**: Animated GIF shown when a child earns a reward
- **Background**: Must be transparent
- **Animation**: Should be celebratory/positive (e.g., reward flying in, appearing with sparkles)

### remove.gif
- **Purpose**: Animated GIF shown when a reward is removed
- **Background**: Must be transparent
- **Animation**: Should indicate removal (e.g., reward flying away, disappearing, fading out)

### icon.png
- **Purpose**: Static icon displayed on the main page and in the progress bar
- **Background**: Must be transparent

## How to Add New Reward Types

1. **Create the directory** (if not already created):
   ```bash
   mkdir images/your-reward-name
   ```

2. **Add the three required files**:
   - Create or obtain `add.gif`, `remove.gif`, and `icon.png`
   - Ensure all backgrounds are transparent
   - Place them in the new directory

3. **Configure in kids.json**:
   Edit your `kids.json` file and set the `"image"` field to your new reward type:
   ```json
   {
     "k1": {
       "name": "Child Name",
       "image": "your-reward-name",
       ...
     }
   }
   ```

4. **Test**: Visit the reward system and verify:
   - The icon appears correctly on the main page
   - The add animation plays when adding a reward
   - The remove animation plays when removing a reward

## Tools for Creating Assets

Since the codebase requires custom image and animation files, here are some tools you can use:

- **Free Online Tools**:
  - [Canva](https://www.canva.com) - Create icons and simple animations
  - [Giphy](https://giphy.com) - Find and customize GIF animations
  - [Ezgif](https://ezgif.com) - GIF editor and converter, can add transparency
  - [Remove.bg](https://remove.bg) - Remove backgrounds from images
  - [Pixabay](https://pixabay.com) / [Pexels](https://pexels.com) - Free stock images and animations

- **Desktop Software**:
  - GIMP (Free) - Full-featured image editor
  - Photoshop - Professional image editor
  - After Effects - Professional animation software

## Example: Looking at Existing Rewards

To understand what the files should look like, examine the existing `rockets` or `stars` directories:

```bash
ls -lh images/rockets/
# You'll see:
# add.gif - Rocket flying animation
# remove.gif - Rocket destroyed animation
# icon.png - Static rocket icon
```

## Tips for Good Reward Icons

1. **Keep it simple**: Icons should be recognizable at small sizes
2. **Bright colors**: Kids respond well to vibrant, cheerful colors
3. **Clear animations**: Make sure the add/remove actions are visually distinct
4. **File size**: Keep GIFs under 2MB for fast loading
5. **Theme appropriate**: Match the reward type to the child's interests
