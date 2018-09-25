#include <stdio.h>
#include <time.h>

int main()
{
  // nvcc ordena_host.cu -arch=sm_52 -o ordenaGPU
  clock_t begin = clock();
   int vetor[10] = {10,4,5,9,10,45,5,4,6,7};

   int tamanho = 10;

  int aux, i, j;

  for(j=tamanho-1; j>=1; j--){
    for(i=0; i<j; i++){
      if(vetor[i]>vetor[i+1]){
        aux=vetor[i];
                    vetor[i]=vetor[i+1];
                    vetor[i+1]=aux;
            }
        }
    }

   for(i = 0; i < 10; i++)
   {
      printf("%d ", vetor[i]);
   }

   printf("\n");
   clock_t end = clock();
   double time_spent = (double)(end - begin) / CLOCKS_PER_SEC;
   printf("Time: %lf\n", time_spent);
   return 0;
}

