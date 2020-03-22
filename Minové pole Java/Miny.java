import java.util.Random;

class Miny {
    int mWidth = 30;
    int mHeight = 10;
    int mMines = 20;
    char[][] mMinefield;

    public Miny() {
        System.out.println("Generování pole");

        mMinefield = new char[mHeight][mWidth];

        System.out.println("Vynulování");

        clearMinefield();

        System.out.println("Rozhození min");

        placeMines();

        drawMinefield();
    }

    public void placeMines() {
        int minesPlaced = 0;
        Random random = new Random();
        while (minesPlaced < mMines) {
            int x = random.nextInt(mWidth);
            int y = random.nextInt(mHeight);

            if (mMinefield[y][x] != '*') {
                mMinefield[y][x] = '*';
                minesPlaced++;
            }
        }
    }

    public void clearMinefield() {
        for (int y = 0; y < mHeight; y++) {
            for (int x = 0; x < mWidth; x++) {
                mMinefield[y][x] = ' ';
            }
        }
    }

    public void drawMinefield() {
        for (int y = 0; y < mHeight; y++) {
            for (int x = 0; x < mWidth; x++) {
                System.out.print(mMinefield[y][x]);
            }
            System.out.print("\n");
        }
    }

    public static void main(String[] args) {
        Miny miny = new Miny();
    }
}