// C program to multiply two square matrices.
#include <stdio.h>
#include <time.h>
#define N 100

// This function multiplies mat1[][] and mat2[][],
// and stores the result in res[][]

int main() {
  // nvcc multmatriz_host.cu --arch=sm_52 -o multmatrizGPU
  clock_t begin = clock();
  int mat1[N][N];
  int mat2[N][N];

  int res[N][N]; // To store result
  int i, j, k;

  char RST_AI1 = 0;
#pragma acc data pcopy(mat1[0 : 10000], mat2[0 : 10000]) if (!RST_AI1)
#pragma acc kernels if (!RST_AI1)
  for (i = 0; i < N; i++) {
    for (j = 0; j < N; j++) {
      mat1[i][j] = 1;
      mat2[i][j] = 2;
    }
  }

  char RST_AI2 = 0;
#pragma acc data pcopyin(mat1[0 : 10000], mat2[0 : 10000])                     \
                             pcopy(res[0 : 10000]) if (!RST_AI2)
#pragma acc kernels if (!RST_AI2)
  for (i = 0; i < N; i++) {
    for (j = 0; j < N; j++) {
      res[i][j] = 0;
      for (k = 0; k < N; k++)
        res[i][j] += mat1[i][k] * mat2[k][j];
    }
  }

  // printf("Result matrix is \n");
  // for (i = 0; i < N; i++)
  // {
  //     for (j = 0; j < N; j++)
  //        printf("%d ", res[i][j]);
  //     printf("\n");
  // }

  printf("\n");
  clock_t end = clock();
  double time_spent = (double)(end - begin) / CLOCKS_PER_SEC;
  printf("Time: %lf\n", time_spent);

  return 0;
}
